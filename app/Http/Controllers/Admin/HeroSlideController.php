<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Throwable;

class HeroSlideController extends Controller
{
    /**
     * Display a listing of hero slides with the slide-over drawer manager.
     */
    public function index(): View
    {
        $error = null;
        $errorDetails = null;

        try {
            $slides = HeroSlide::orderBy('order')->orderBy('id')->get();
        } catch (Throwable $e) {
            report($e);
            $slides = collect();
            $error = 'We are having trouble loading the hero slides right now. Please try refreshing the page.';
            $errorDetails = $e->getMessage();
        }

        return view('admin.hero.index', compact('slides', 'error', 'errorDetails'));
    }

    /**
     * Store a newly created hero slide in storage.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:180'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'image_alt' => ['nullable', 'string', 'max:200'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('hero_slides', 'public');
                $validated['image_path'] = $path;
            }

            $order = $validated['order'] ?? (HeroSlide::max('order') + 1);
            $validated['order'] = $order;
            $validated['title'] = ! empty($validated['title']) ? $validated['title'] : 'Hero Slide #'.$order;
            $validated['image_alt'] = $validated['image_alt'] ?? $validated['title'];
            $validated['is_active'] = $request->boolean('is_active');

            unset($validated['image']);

            $slide = HeroSlide::create($validated);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'New hero slide added successfully!',
                    'data' => $slide,
                ]);
            }

            return redirect()->route('admin.hero-slides.index')
                ->with('success', 'New hero slide added successfully!');
        } catch (Throwable $e) {
            report($e);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create slide: '.$e->getMessage(),
                ], 500);
            }

            return back()->withInput()->with('error', 'Failed to create slide: '.$e->getMessage());
        }
    }

    /**
     * Update the specified hero slide in storage.
     */
    public function update(Request $request, HeroSlide $heroSlide): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:180'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'image_alt' => ['nullable', 'string', 'max:200'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        try {
            if ($request->hasFile('image')) {
                if (! empty($heroSlide->image_path) && (str_starts_with($heroSlide->image_path, 'hero_slides/') || str_starts_with($heroSlide->image_path, 'hero/'))) {
                    Storage::disk('public')->delete($heroSlide->image_path);
                }

                $file = $request->file('image');
                $path = $file->store('hero_slides', 'public');
                $validated['image_path'] = $path;
            }

            $order = $validated['order'] ?? $heroSlide->order;
            $validated['title'] = ! empty($validated['title']) ? $validated['title'] : ($heroSlide->title ?? 'Hero Slide #'.$order);
            $validated['image_alt'] = $validated['image_alt'] ?? $heroSlide->image_alt ?? $validated['title'];
            $validated['is_active'] = $request->boolean('is_active');

            unset($validated['image']);

            $heroSlide->update($validated);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Hero slide updated successfully!',
                    'data' => $heroSlide->fresh(),
                ]);
            }

            return redirect()->route('admin.hero-slides.index')
                ->with('success', 'Hero slide updated successfully!');
        } catch (Throwable $e) {
            report($e);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update slide: '.$e->getMessage(),
                ], 500);
            }

            return back()->withInput()->with('error', 'Failed to update slide: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified hero slide from storage.
     */
    public function destroy(Request $request, HeroSlide $heroSlide): RedirectResponse|JsonResponse
    {
        try {
            $title = $heroSlide->title;

            if (! empty($heroSlide->image_path) && (str_starts_with($heroSlide->image_path, 'hero_slides/') || str_starts_with($heroSlide->image_path, 'hero/'))) {
                Storage::disk('public')->delete($heroSlide->image_path);
            }

            $heroSlide->delete();

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Hero slide '{$title}' removed successfully.",
                ]);
            }

            return redirect()->route('admin.hero-slides.index')
                ->with('success', "Hero slide '{$title}' removed successfully.");
        } catch (Throwable $e) {
            report($e);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete slide: '.$e->getMessage(),
                ], 500);
            }

            return back()->with('error', 'Failed to delete slide: '.$e->getMessage());
        }
    }

    /**
     * Toggle the active status of a hero slide.
     */
    public function toggleStatus(HeroSlide $heroSlide): RedirectResponse
    {
        try {
            $heroSlide->update(['is_active' => ! $heroSlide->is_active]);

            $status = $heroSlide->is_active ? 'activated' : 'deactivated';

            return redirect()->route('admin.hero-slides.index')
                ->with('success', "Slide '{$heroSlide->title}' is now {$status}.");
        } catch (Throwable $e) {
            report($e);

            return back()->with('error', 'Failed to toggle status: '.$e->getMessage());
        }
    }
}
