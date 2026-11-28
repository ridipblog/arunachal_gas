<?php

namespace Tests\Feature;

use App\Models\HeroSlide;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('welcome');
        $response->assertViewHasAll(['services', 'heroSlides']);
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
}
