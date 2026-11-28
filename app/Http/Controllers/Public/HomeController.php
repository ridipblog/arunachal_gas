<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    /**
     * Display the public homepage with dynamic services and hero slides.
     */
    public function index(): View
    {
        $services = collect();
        $heroSlides = collect();

        try {
            $services = Service::where('is_active', true)
                ->orderBy('order')
                ->orderBy('id')
                ->get();

            $heroSlides = HeroSlide::where('is_active', true)
                ->orderBy('order')
                ->orderBy('id')
                ->get();
        } catch (Throwable $e) {
            Log::channel('daily')->error('Failed to load homepage content: '.$e->getMessage(), [
                'exception' => $e,
            ]);
        }

        if ($heroSlides->isEmpty()) {
            $heroSlides = $this->fallbackHeroSlides();
        }

        return view('welcome', compact('services', 'heroSlides'));
    }

    /**
     * Fallback hero slides used when no slides are published or the database is unavailable.
     *
     * @return list<array{id: int, image_url: string, image_alt: string}>
     */
    private function fallbackHeroSlides(): array
    {
        return [
            [
                'id' => 1,
                'image_url' => asset('images/assets/Group 1000002719.png'),
                'image_alt' => 'Connecting Arunachal Pradesh to a Cleaner Energy Future',
            ],
            [
                'id' => 2,
                'image_url' => asset('images/assets/hero_2.png'),
                'image_alt' => 'Empowering Transportation with Cleaner Energy for a Better Tomorrow',
            ],
            [
                'id' => 3,
                'image_url' => asset('images/assets/hero_3.png'),
                'image_alt' => 'Bringing Safe and Reliable Natural Gas to Your Home',
            ],
        ];
    }
}
