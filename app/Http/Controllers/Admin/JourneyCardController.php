<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JourneyCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Throwable;

class JourneyCardController extends Controller
{
    /**
     * Display a listing of journey showcase cards with slide-over drawer manager.
     */
    public function index(): View
    {
        $error = null;
        $errorDetails = null;

        try {
            $cards = JourneyCard::orderBy('order')->orderBy('id')->get();
        } catch (Throwable $e) {
            report($e);
            $cards = collect();
            $error = 'We are having trouble loading the journey showcase cards right now. Please try refreshing the page.';
            $errorDetails = $e->getMessage();
        }

        return view('admin.journey.index', compact('cards', 'error', 'errorDetails'));
    }

    /**
     * Store a newly created journey card in storage.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'image_alt' => ['nullable', 'string', 'max:180'],
            'order' => ['nullable', 'integer'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('journey', 'public');
                $validated['image_path'] = $path;
            }

            $validated['image_alt'] = $validated['image_alt'] ?? $validated['title'];
            $validated['order'] = $validated['order'] ?? (JourneyCard::max('order') + 1);
            $validated['is_active'] = $request->boolean('is_active', true);

            unset($validated['image']);

            $card = JourneyCard::create($validated);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'New journey card added successfully!',
                    'data' => $card,
                ]);
            }

            return redirect()->route('admin.journey-cards.index')
                ->with('success', 'New journey card added successfully!');
        } catch (Throwable $e) {
            report($e);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create journey card: '.$e->getMessage(),
                ], 500);
            }

            return back()->withInput()->with('error', 'Failed to create journey card: '.$e->getMessage());
        }
    }

    /**
     * Update the specified journey card in storage.
     */
    public function update(Request $request, JourneyCard $journeyCard): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'image_alt' => ['nullable', 'string', 'max:180'],
            'order' => ['nullable', 'integer'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        try {
            if ($request->hasFile('image')) {
                if (! empty($journeyCard->image_path) && (str_starts_with($journeyCard->image_path, 'journey/') || str_starts_with($journeyCard->image_path, 'uploads/'))) {
                    Storage::disk('public')->delete($journeyCard->image_path);
                }

                $file = $request->file('image');
                $path = $file->store('journey', 'public');
                $validated['image_path'] = $path;
            }

            $validated['image_alt'] = $validated['image_alt'] ?? $validated['title'];
            $validated['is_active'] = $request->boolean('is_active');

            unset($validated['image']);

            $journeyCard->update($validated);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Journey card updated successfully!',
                    'data' => $journeyCard->fresh(),
                ]);
            }

            return redirect()->route('admin.journey-cards.index')
                ->with('success', 'Journey card updated successfully!');
        } catch (Throwable $e) {
            report($e);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update journey card: '.$e->getMessage(),
                ], 500);
            }

            return back()->withInput()->with('error', 'Failed to update journey card: '.$e->getMessage());
        }
    }

    /**
     * Toggle active status of a journey card.
     */
    public function toggleStatus(JourneyCard $journeyCard): RedirectResponse|JsonResponse
    {
        try {
            $journeyCard->update(['is_active' => ! $journeyCard->is_active]);

            $statusText = $journeyCard->is_active ? 'published' : 'moved to drafts';

            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Card '{$journeyCard->title}' is now {$statusText}!",
                    'is_active' => $journeyCard->is_active,
                ]);
            }

            return redirect()->route('admin.journey-cards.index')
                ->with('success', "Card '{$journeyCard->title}' is now {$statusText}!");
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
     * Remove the specified journey card from storage.
     */
    public function destroy(JourneyCard $journeyCard): RedirectResponse|JsonResponse
    {
        try {
            $title = $journeyCard->title;

            if (! empty($journeyCard->image_path) && (str_starts_with($journeyCard->image_path, 'journey/') || str_starts_with($journeyCard->image_path, 'uploads/'))) {
                Storage::disk('public')->delete($journeyCard->image_path);
            }

            $journeyCard->delete();

            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Journey card '{$title}' deleted successfully!",
                ]);
            }

            return redirect()->route('admin.journey-cards.index')
                ->with('success', "Journey card '{$title}' deleted successfully!");
        } catch (Throwable $e) {
            report($e);

            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete journey card: '.$e->getMessage(),
                ], 500);
            }

            return back()->with('error', 'Failed to delete journey card: '.$e->getMessage());
        }
    }
}
