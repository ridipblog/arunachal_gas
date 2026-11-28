<?php

namespace Tests\Feature;

use App\Enums\NoticeBadge;
use App\Enums\NoticeType;
use App\Models\HeroSlide;
use App\Models\JourneyCard;
use App\Models\Notice;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('welcome');
        $response->assertViewHasAll(['services', 'heroSlides', 'notices', 'journeyCards']);
    }

    public function test_homepage_displays_active_services_and_hero_slides(): void
    {
        HeroSlide::create([
            'title' => 'Test Hero Title',
            'image_path' => 'hero/test.jpg',
            'image_alt' => 'Test Hero Alt',
            'order' => 1,
            'is_active' => true,
        ]);

        Service::create([
            'number_label' => '01',
            'title' => 'Domestic PNG',
            'slug' => 'domestic-png',
            'card_heading' => 'Domestic Natural Gas',
            'image_path' => 'services/test.jpg',
            'description' => 'Test Service Description',
            'order' => 1,
            'is_active' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Test Hero Title');
        $response->assertSee('Domestic PNG');
    }

    public function test_hero_slider_component_renders_gracefully_with_empty_or_null_slides(): void
    {
        $viewWithNull = $this->blade('<x-hero-slider :slides="null" />');
        $viewWithNull->assertSee('hero-shrink-container');

        $viewWithEmpty = $this->blade('<x-hero-slider :slides="[]" />');
        $viewWithEmpty->assertSee('hero-shrink-container');
    }

    public function test_capturing_journey_component_renders_gracefully_with_empty_or_null_or_invalid_cards(): void
    {
        $viewWithNull = $this->blade('<x-capturing-journey :cards="null" />');
        $viewWithNull->assertSee('Capturing Our');
        $viewWithNull->assertSee('Explore Gallery');

        $viewWithEmpty = $this->blade('<x-capturing-journey :cards="[]" />');
        $viewWithEmpty->assertSee('Capturing Our');
        $viewWithEmpty->assertSee('Explore Gallery');

        $viewWithInvalid = $this->blade('<x-capturing-journey :cards="\'invalid-string\'" />');
        $viewWithInvalid->assertSee('Capturing Our');
        $viewWithInvalid->assertSee('Explore Gallery');
    }

    public function test_homepage_falls_back_to_default_journey_cards_when_database_empty(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Energy Infrastructure');
        $response->assertSee('People Behind Progress');
        $response->assertSee('Towards a Greener Future');
    }

    public function test_homepage_loads_only_latest_five_active_journey_cards(): void
    {
        for ($i = 1; $i <= 8; $i++) {
            JourneyCard::create([
                'title' => "Journey Card {$i}",
                'description' => "Description {$i}",
                'image_path' => "journey/test_{$i}.jpg",
                'image_alt' => "Alt {$i}",
                'order' => $i,
                'is_active' => true,
            ]);
        }

        $response = $this->get('/');

        $response->assertStatus(200);
        /** @var Collection<int, JourneyCard> $cards */
        $cards = $response->viewData('journeyCards');
        $this->assertCount(5, $cards);
        $this->assertSame('Journey Card 8', $cards->first()->title);
    }

    public function test_homepage_loads_only_latest_four_active_notices(): void
    {
        for ($i = 1; $i <= 6; $i++) {
            Notice::create([
                'title' => "Notice {$i}",
                'description' => "Notice description {$i}",
                'type' => NoticeType::Notice,
                'badge' => NoticeBadge::New,
                'date_text' => 'Today',
                'order' => $i,
                'is_active' => true,
            ]);
        }

        $response = $this->get('/');

        $response->assertStatus(200);
        /** @var Collection<int, Notice> $notices */
        $notices = $response->viewData('notices');
        $this->assertCount(4, $notices);
        $this->assertSame('Notice 6', $notices->first()->title);
    }
}
