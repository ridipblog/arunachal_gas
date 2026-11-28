<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Milestone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

class MilestoneController extends Controller
{
    /**
     * Allowed preset icon keys.
     *
     * @var list<string>
     */
    public const ICONS = [
        'document',
        'gavel',
        'handshake',
        'verified',
        'users',
        'megaphone',
        'map-pin',
        'settings',
    ];

    /**
     * Display a listing of key milestones.
     */
    public function index(): View
    {
        $error = null;
        $errorDetails = null;

        try {
            $milestones = Milestone::orderBy('order')->orderBy('id')->get();
        } catch (Throwable $e) {
            report($e);
            $milestones = collect();
            $error = 'We are having trouble loading key milestones right now. Please try refreshing the page.';
            $errorDetails = $e->getMessage();
        }

        return view('admin.milestones.index', compact('milestones', 'error', 'errorDetails'));
    }

    /**
     * Store a newly created milestone in storage.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'period' => ['required', 'string', 'max:60'],
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string', Rule::in(self::ICONS)],
            'custom_icon' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'is_highlighted' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        try {
            if ($request->hasFile('custom_icon')) {
                $path = $request->file('custom_icon')->store('milestones', 'public');
                $validated['custom_icon_path'] = $path;
            }

            $validated['order'] = $validated['order'] ?? (Milestone::max('order') + 1);
            $validated['is_highlighted'] = $request->boolean('is_highlighted', false);
            $validated['is_active'] = $request->boolean('is_active', true);

            unset($validated['custom_icon']);

            $milestone = Milestone::create($validated);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'New key milestone added successfully!',
                    'data' => $milestone,
                ]);
            }

            return redirect()
                ->route('admin.milestones.index')
                ->with('status', 'New key milestone added successfully!');
        } catch (Throwable $e) {
            report($e);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to save milestone. Please check input and try again.',
                    'error' => $e->getMessage(),
                ], 500);
            }

            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to save milestone. Please try again.']);
        }
    }

    /**
     * Update the specified milestone in storage.
     */
    public function update(Request $request, Milestone $milestone): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'period' => ['required', 'string', 'max:60'],
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string', Rule::in(self::ICONS)],
            'custom_icon' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'is_highlighted' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        try {
            if ($request->hasFile('custom_icon')) {
                if (! empty($milestone->custom_icon_path) && ! str_starts_with($milestone->custom_icon_path, 'images/')) {
                    Storage::disk('public')->delete($milestone->custom_icon_path);
                }
                $path = $request->file('custom_icon')->store('milestones', 'public');
                $validated['custom_icon_path'] = $path;
            }

            $validated['order'] = $validated['order'] ?? $milestone->order;
            $validated['is_highlighted'] = $request->boolean('is_highlighted', false);
            $validated['is_active'] = $request->boolean('is_active', true);

            unset($validated['custom_icon']);

            $milestone->update($validated);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Milestone updated successfully!',
                    'data' => $milestone->fresh(),
                ]);
            }

            return redirect()
                ->route('admin.milestones.index')
                ->with('status', 'Milestone updated successfully!');
        } catch (Throwable $e) {
            report($e);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update milestone. Please try again.',
                    'error' => $e->getMessage(),
                ], 500);
            }

            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update milestone. Please try again.']);
        }
    }

    /**
     * Toggle the active status of a milestone.
     */
    public function toggleStatus(Request $request, Milestone $milestone): JsonResponse
    {
        try {
            $milestone->is_active = ! $milestone->is_active;
            $milestone->save();

            return response()->json([
                'success' => true,
                'is_active' => (bool) $milestone->is_active,
                'message' => $milestone->is_active ? 'Milestone published.' : 'Milestone moved to draft.',
            ]);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Could not update status. Please try again.',
            ], 500);
        }
    }

    /**
     * Remove the specified milestone from storage.
     */
    public function destroy(Request $request, Milestone $milestone): RedirectResponse|JsonResponse
    {
        try {
            if (! empty($milestone->custom_icon_path) && ! str_starts_with($milestone->custom_icon_path, 'images/')) {
                Storage::disk('public')->delete($milestone->custom_icon_path);
            }

            $milestone->delete();

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Milestone deleted successfully!',
                ]);
            }

            return redirect()
                ->route('admin.milestones.index')
                ->with('status', 'Milestone deleted successfully!');
        } catch (Throwable $e) {
            report($e);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Could not delete milestone. Please try again.',
                ], 500);
            }

            return redirect()
                ->route('admin.milestones.index')
                ->withErrors(['error' => 'Could not delete milestone. Please try again.']);
        }
    }
}
