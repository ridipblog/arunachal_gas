<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class ServiceController extends Controller
{
    /**
     * Display a listing of services with the slide-over drawer manager.
     */
    public function index(): View
    {
        $error = null;
        $errorDetails = null;

        try {
            $services = Service::orderBy('oder')->orderBy('id')->get();
        } catch (Throwable $e) {
            report($e);
            $services = collect();
            $error = 'We are having trouble loading the services records right now. Please try refreshing the page.';
            $errorDetails = $e->getMessage();
        }

        return view('admin.services.index', compact('services', 'error', 'errorDetails'));
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'number_label' => ['required', 'string', 'max:10'],
            'title' => ['required', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:150', 'unique:services,slug'],
            'card_heading' => ['required', 'string'],
            'badges' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'image_alt' => ['nullable', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'button_text' => ['nullable', 'string', 'max:60'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        try {
            // Generate slug if empty
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['title']);
                $originalSlug = $validated['slug'];
                $count = 1;
                while (Service::where('slug', $validated['slug'])->exists()) {
                    $validated['slug'] = "{$originalSlug}-{$count}";
                    $count++;
                }
            }

            // Parse badges
            $validated['badges'] = $this->parseBadges($request->input('badges'));

            // Handle Image Upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('services', 'public');
                $validated['image_path'] = $path;
            }

            $validated['button_text'] = $validated['button_text'] ?? 'Know More';
            $validated['button_url'] = $validated['button_url'] ?? '#contact';
            $validated['order'] = $validated['order'] ?? (Service::max('order') + 1);
            $validated['is_active'] = $request->boolean('is_active');

            unset($validated['image']);

            $service = Service::create($validated);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'New service added successfully!',
                    'data' => $service,
                ]);
            }

            return redirect()->route('admin.services.index')
                ->with('success', 'New service added successfully!');
        } catch (Throwable $e) {
            report($e);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create service: '.$e->getMessage(),
                ], 500);
            }

            return back()->withInput()->with('error', 'Failed to create service: '.$e->getMessage());
        }
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Service $service): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'number_label' => ['required', 'string', 'max:10'],
            'title' => ['required', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:150', 'unique:services,slug,'.$service->id],
            'card_heading' => ['required', 'string'],
            'badges' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'image_alt' => ['nullable', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'button_text' => ['nullable', 'string', 'max:60'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        try {
            // Parse badges
            $validated['badges'] = $this->parseBadges($request->input('badges'));

            // Handle Image Replacement
            if ($request->hasFile('image')) {
                // Delete old uploaded image if stored in public storage
                if (! empty($service->image_path) && str_starts_with($service->image_path, 'services/')) {
                    Storage::disk('public')->delete($service->image_path);
                }

                $file = $request->file('image');
                $path = $file->store('services', 'public');
                $validated['image_path'] = $path;
            }

            $validated['button_text'] = $validated['button_text'] ?? 'Know More';
            $validated['button_url'] = $validated['button_url'] ?? '#contact';
            $validated['is_active'] = $request->boolean('is_active');

            unset($validated['image']);

            $service->update($validated);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Service '{$service->title}' updated successfully!",
                    'data' => $service->fresh(),
                ]);
            }

            return redirect()->route('admin.services.index')
                ->with('success', "Service '{$service->title}' updated successfully!");
        } catch (Throwable $e) {
            report($e);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update service: '.$e->getMessage(),
                ], 500);
            }

            return back()->withInput()->with('error', 'Failed to update service: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Request $request, Service $service): RedirectResponse|JsonResponse
    {
        try {
            $title = $service->title;

            if (! empty($service->image_path) && str_starts_with($service->image_path, 'services/')) {
                Storage::disk('public')->delete($service->image_path);
            }

            $service->delete();

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Service '{$title}' has been removed successfully.",
                ]);
            }

            return redirect()->route('admin.services.index')
                ->with('success', "Service '{$title}' has been removed.");
        } catch (Throwable $e) {
            report($e);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete service: '.$e->getMessage(),
                ], 500);
            }

            return back()->with('error', 'Failed to delete service: '.$e->getMessage());
        }
    }

    /**
     * Toggle the active status of a service.
     */
    public function toggleStatus(Service $service): RedirectResponse
    {
        try {
            $service->update(['is_active' => ! $service->is_active]);

            $status = $service->is_active ? 'activated' : 'deactivated';

            return redirect()->route('admin.services.index')
                ->with('success', "Service '{$service->title}' is now {$status}.");
        } catch (Throwable $e) {
            report($e);

            return back()->with('error', 'Failed to toggle status: '.$e->getMessage());
        }
    }

    /**
     * Helper to parse comma-separated badges into a clean array.
     *
     * @return array<string>
     */
    private function parseBadges(?string $badgesInput): array
    {
        if (empty($badgesInput)) {
            return [];
        }

        if (str_starts_with(trim($badgesInput), '[')) {
            $decoded = json_decode($badgesInput, true);
            if (is_array($decoded)) {
                return array_filter(array_map('trim', $decoded));
            }
        }

        return array_values(array_filter(array_map('trim', explode(',', $badgesInput))));
    }
}
