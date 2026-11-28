<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\JourneyCard;
use App\Models\Milestone;
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
        $milestones = collect();

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

            $milestones = Milestone::where('is_active', true)
                ->orderBy('order')
                ->orderBy('id')
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

        if ($milestones->isEmpty()) {
            $milestones = $this->fallbackMilestones();
        }

        return view('welcome', compact('services', 'heroSlides', 'notices', 'journeyCards', 'milestones'));
    }

    /**
     * Fallback key milestones used when no milestones are published or the database is unavailable.
     *
     * @return list<array{id: int, period: string, title: string, icon: string, is_highlighted: bool, order: int}>
     */
    private function fallbackMilestones(): array
    {
        return [
            [
                'id' => 1,
                'period' => 'Dec 2023',
                'title' => 'BPCL Board approves bid strategy for CGD Round 12 & 12A',
                'icon' => 'document',
                'is_highlighted' => false,
                'order' => 1,
            ],
            [
                'id' => 2,
                'period' => 'Apr 2024',
                'title' => 'PNGRB grants CGD authorisation for GA-12.01 to BPCL–OIL Consortium',
                'icon' => 'gavel',
                'is_highlighted' => false,
                'order' => 2,
            ],
            [
                'id' => 3,
                'period' => 'Oct–Nov 2024',
                'title' => 'BPCL & OIL Boards approve JVA; DIPAM/MoPNG guidelines followed',
                'icon' => 'handshake',
                'is_highlighted' => false,
                'order' => 3,
            ],
            [
                'id' => 4,
                'period' => 'Jun 2025',
                'title' => 'DIPAM concurrence & MoPNG approval received for JV formation',
                'icon' => 'verified',
                'is_highlighted' => false,
                'order' => 4,
            ],
            [
                'id' => 5,
                'period' => '2025–26',
                'title' => 'AGPL incorporated; Board, CEO, CFO and core team operationalised',
                'icon' => 'users',
                'is_highlighted' => false,
                'order' => 5,
            ],
            [
                'id' => 6,
                'period' => 'Jun 2026',
                'title' => "Stakeholder outreach launched — DC-ICR, Director (Earth Sciences), Hon'ble Home Minister, Arunachal Pradesh",
                'icon' => 'megaphone',
                'is_highlighted' => false,
                'order' => 6,
            ],
            [
                'id' => 7,
                'period' => 'Aug 2026',
                'title' => "Namsai district engagement — Hon'ble MLA & DC Namsai; Namsai proposed as role-model district",
                'icon' => 'map-pin',
                'is_highlighted' => false,
                'order' => 7,
            ],
            [
                'id' => 8,
                'period' => 'Aug 2026',
                'title' => 'Management Review — governance, procurement and financing workstreams active',
                'icon' => 'settings',
                'is_highlighted' => true,
                'order' => 8,
            ],
        ];
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
