<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\JourneyCard;
use App\Models\Notice;
use App\Models\Service;
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
        $notices = collect();
        $journeyCards = collect();

        try {
            $services = Service::where('is_active', true)
                ->orderBy('order')
                ->orderBy('id')
                ->get();

            $heroSlides = HeroSlide::where('is_active', true)
                ->orderBy('order')
                ->orderBy('id')
                ->get();

            $notices = Notice::where('is_active', true)
                ->latest()
                ->orderByDesc('id')
                ->take(4)
                ->get();

            $journeyCards = JourneyCard::where('is_active', true)
                ->latest()
                ->orderByDesc('id')
                ->take(5)
                ->get();
        } catch (Throwable $e) {
            report($e);
        }

        if ($heroSlides->isEmpty()) {
            $heroSlides = $this->fallbackHeroSlides();
        }

        if ($journeyCards->isEmpty()) {
            $journeyCards = $this->fallbackJourneyCards();
        }

        return view('welcome', compact('services', 'heroSlides', 'notices', 'journeyCards'));
    }

    /**
     * Fallback journey cards used when no journey cards are published or the database is unavailable.
     *
     * @return list<array{id: int, title: string, description: string, image_url: string, image_alt: string}>
     */
    private function fallbackJourneyCards(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Energy Infrastructure',
                'description' => 'Building safe energy networks for tomorrow.',
                'image_url' => asset('images/assets/journey_1.png'),
                'image_alt' => 'Energy Infrastructure',
            ],
            [
                'id' => 2,
                'title' => 'People Behind Progress',
                'description' => 'Our teams making a difference every day.',
                'image_url' => asset('images/assets/journey_2.png'),
                'image_alt' => 'People Behind Progress',
            ],
            [
                'id' => 3,
                'title' => 'Towards a Greener Future',
                'description' => 'Moving towards sustainable energy solutions.',
                'image_url' => asset('images/assets/journey_3.png'),
                'image_alt' => 'Towards a Greener Future',
            ],
            [
                'id' => 4,
                'title' => 'Events & Engagements',
                'description' => 'Connecting people and ideas.',
                'image_url' => asset('images/assets/journey_4.png'),
                'image_alt' => 'Events & Engagements',
            ],
            [
                'id' => 5,
                'title' => 'Collaboration & Planning',
                'description' => 'Working together towards shared goals.',
                'image_url' => asset('images/assets/journey_5.png'),
                'image_alt' => 'Collaboration & Planning',
            ],
        ];
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
