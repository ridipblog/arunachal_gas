<?php

namespace Tests\Feature;

use App\Models\HeroSlide;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminHeroSlideTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->admin = User::where('email', 'admin@agpl.in')->firstOrFail();
    }

    public function test_guest_is_redirected_to_login_when_accessing_hero_slides(): void
    {
        $response = $this->get('/admin/hero-slides');

        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_view_hero_slides_list_with_alpine_drawer_bindings(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/hero-slides');

        $response->assertStatus(200);
        $response->assertSee('x-data="heroManager', false);
        $response->assertSee('openEditDrawer', false);
        $response->assertSee('openCreateDrawer', false);
        $response->assertSee('Connecting Arunachal Pradesh to a Cleaner Energy Future');
    }

    public function test_admin_can_create_a_new_hero_slide_via_ajax(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->postJson('/admin/hero-slides', [
            'title' => 'Empowering Arunachal with Sustainable Gas',
            'image_alt' => 'Mountain gas pipeline and clean energy',
            'order' => 4,
            'is_active' => '1',
            'image' => UploadedFile::fake()->image('hero_banner.jpg', 1920, 1080),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'New hero slide added successfully!',
        ]);

        $this->assertDatabaseHas('hero_slides', [
            'title' => 'Empowering Arunachal with Sustainable Gas',
            'order' => 4,
            'is_active' => true,
        ]);
    }

    public function test_admin_can_create_a_new_hero_slide_without_title_and_alt(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->postJson('/admin/hero-slides', [
            'order' => 5,
            'is_active' => '1',
            'image' => UploadedFile::fake()->image('hero_banner2.jpg', 1920, 1080),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'New hero slide added successfully!',
        ]);

        $this->assertDatabaseHas('hero_slides', [
            'title' => 'Hero Slide #5',
            'order' => 5,
            'is_active' => true,
        ]);
    }

    public function test_admin_can_update_a_hero_slide_via_ajax(): void
    {
        $slide = HeroSlide::firstOrFail();

        $response = $this->actingAs($this->admin)->putJson('/admin/hero-slides/'.$slide->id, [
            'title' => 'Updated Arunachal Energy Vision',
            'image_alt' => 'Updated alt text description',
            'order' => 1,
            'is_active' => '1',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('hero_slides', [
            'id' => $slide->id,
            'title' => 'Updated Arunachal Energy Vision',
        ]);
    }

    public function test_admin_can_toggle_hero_slide_active_status(): void
    {
        $slide = HeroSlide::firstOrFail();
        $initialStatus = $slide->is_active;

        $response = $this->actingAs($this->admin)->post('/admin/hero-slides/'.$slide->id.'/toggle');

        $response->assertRedirect('/admin/hero-slides');
        $this->assertDatabaseHas('hero_slides', [
            'id' => $slide->id,
            'is_active' => ! $initialStatus,
        ]);
    }

    public function test_admin_can_delete_a_hero_slide_via_ajax(): void
    {
        $slide = HeroSlide::create([
            'title' => 'Temporary Test Slide',
            'image_path' => 'images/assets/temporary.png',
            'image_alt' => 'Temporary alt',
            'order' => 99,
            'is_active' => false,
        ]);

        $response = $this->actingAs($this->admin)->deleteJson('/admin/hero-slides/'.$slide->id);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseMissing('hero_slides', [
            'id' => $slide->id,
        ]);
    }

    public function test_ajax_hero_slide_validation_error_returns_unprocessable_status(): void
    {
        $response = $this->actingAs($this->admin)->postJson('/admin/hero-slides', [
            // No image provided
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['image']);
    }

    public function test_admin_hero_slides_displays_error_component_when_controller_catches_error(): void
    {
        $view = $this->actingAs($this->admin)->view('admin.hero.index', [
            'slides' => collect(),
            'error' => 'Simulated database failure for hero',
            'errorDetails' => 'Connection timeout',
        ]);

        $view->assertSee('Failed to Load Hero Slides');
        $view->assertSee('Refresh Page');
    }
}
