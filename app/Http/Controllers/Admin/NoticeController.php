<?php

namespace App\Http\Controllers\Admin;

use App\Enums\NoticeBadge;
use App\Enums\NoticeType;
use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

class NoticeController extends Controller
{
    /**
     * Display a listing of notices, events, and announcements with slide-over drawer manager.
     */
    public function index(): View
    {
        $error = null;
        $errorDetails = null;

        try {
            $notices = Notice::orderBy('order')->orderBy('id')->get();
        } catch (Throwable $e) {
            report($e);
            $notices = collect();
            $error = 'We are having trouble loading the notices right now. Please try refreshing the page.';
            $errorDetails = $e->getMessage();
        }

        $types = NoticeType::cases();
        $badges = NoticeBadge::cases();

        return view('admin.notices.index', compact('notices', 'error', 'errorDetails', 'types', 'badges'));
    }

    /**
     * Store a newly created notice in storage.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string'],
            'date_text' => ['nullable', 'string', 'max:100'],
            'type' => ['required', Rule::enum(NoticeType::class)],
            'badge' => ['nullable', Rule::enum(NoticeBadge::class)],
            'icon' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        try {
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $path = $file->store('notices', 'public');
                $validated['icon_path'] = $path;
            }

            $validated['date_text'] = ! empty($validated['date_text'])
                ? $validated['date_text']
                : now()->format('d M Y - h:i A');

            $validated['order'] = $validated['order'] ?? (Notice::max('order') + 1);
            $validated['is_active'] = $request->boolean('is_active', true);

            unset($validated['icon']);

            $notice = Notice::create($validated);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'New notice / event added successfully!',
                    'data' => $notice,
                ]);
            }

            return redirect()->route('admin.notices.index')
                ->with('success', 'New notice / event added successfully!');
        } catch (Throwable $e) {
            report($e);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create notice: '.$e->getMessage(),
                ], 500);
            }

            return back()->withInput()->with('error', 'Failed to create notice: '.$e->getMessage());
        }
    }

    /**
     * Update the specified notice in storage.
     */
    public function update(Request $request, Notice $notice): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string'],
            'date_text' => ['nullable', 'string', 'max:100'],
            'type' => ['required', Rule::enum(NoticeType::class)],
            'badge' => ['nullable', Rule::enum(NoticeBadge::class)],
            'icon' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        try {
            if ($request->hasFile('icon')) {
                if (! empty($notice->icon_path) && (str_starts_with($notice->icon_path, 'notices/') || str_starts_with($notice->icon_path, 'uploads/'))) {
                    Storage::disk('public')->delete($notice->icon_path);
                }

                $file = $request->file('icon');
                $path = $file->store('notices', 'public');
                $validated['icon_path'] = $path;
            }

            $validated['date_text'] = ! empty($validated['date_text'])
                ? $validated['date_text']
                : ($notice->date_text ?? now()->format('d M Y - h:i A'));

            $validated['is_active'] = $request->boolean('is_active');

            unset($validated['icon']);

            $notice->update($validated);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Notice / event updated successfully!',
                    'data' => $notice->fresh(),
                ]);
            }

            return redirect()->route('admin.notices.index')
                ->with('success', 'Notice / event updated successfully!');
        } catch (Throwable $e) {
            report($e);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update notice: '.$e->getMessage(),
                ], 500);
            }

            return back()->withInput()->with('error', 'Failed to update notice: '.$e->getMessage());
        }
    }

    /**
     * Toggle the active/draft status of a notice.
     */
    public function toggleStatus(Notice $notice): RedirectResponse|JsonResponse
    {
        try {
            $notice->update(['is_active' => ! $notice->is_active]);

            $statusText = $notice->is_active ? 'published' : 'moved to drafts';

            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Notice '{$notice->title}' is now {$statusText}!",
                    'is_active' => $notice->is_active,
                ]);
            }

            return redirect()->route('admin.notices.index')
                ->with('success', "Notice '{$notice->title}' is now {$statusText}!");
        } catch (Throwable $e) {
            report($e);

            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to toggle status: '.$e->getMessage(),
                ], 500);
            }

            return back()->with('error', 'Failed to toggle status: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified notice from storage.
     */
    public function destroy(Notice $notice): RedirectResponse|JsonResponse
    {
        try {
            $title = $notice->title;

            if (! empty($notice->icon_path) && (str_starts_with($notice->icon_path, 'notices/') || str_starts_with($notice->icon_path, 'uploads/'))) {
                Storage::disk('public')->delete($notice->icon_path);
            }

            $notice->delete();

            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Notice '{$title}' deleted successfully!",
                ]);
            }

            return redirect()->route('admin.notices.index')
                ->with('success', "Notice '{$title}' deleted successfully!");
        } catch (Throwable $e) {
            report($e);

            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete notice: '.$e->getMessage(),
                ], 500);
            }

            return back()->with('error', 'Failed to delete notice: '.$e->getMessage());
        }
    }
}
