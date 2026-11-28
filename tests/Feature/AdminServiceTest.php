<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminServiceTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->admin = User::where('email', 'admin@agpl.in')->firstOrFail();
    }

    public function test_admin_can_view_services_list_with_alpine_drawer_bindings(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/services');

        $response->assertStatus(200);
        $response->assertSee('x-data="serviceManager', false);
        $response->assertSee('openEditDrawer', false);
        $response->assertSee('openCreateDrawer', false);
        $response->assertSee('Domestic PNG');
    }

    public function test_admin_can_create_a_new_service(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->post('/admin/services', [
            'number_label' => '07/',
            'title' => 'Industrial Bio-Gas',
            'card_heading' => 'Green Renewable Energy Solutions',
            'badges' => 'Eco-friendly, Renewable, Cost-effective',
            'description' => 'AGPL is expanding into renewable biogas solutions for heavy industries.',
            'button_text' => 'Learn More',
            'button_url' => '#contact',
            'order' => 7,
            'is_active' => '1',
            'image' => UploadedFile::fake()->image('biogas.png', 800, 600),
        ]);

        $response->assertRedirect('/admin/services');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('services', [
            'title' => 'Industrial Bio-Gas',
            'slug' => 'industrial-bio-gas',
            'order' => 7,
            'is_active' => true,
        ]);
    }

    public function test_admin_can_update_an_existing_service(): void
    {
        $service = Service::firstOrFail();

        $response = $this->actingAs($this->admin)->put('/admin/services/'.$service->id, [
            'number_label' => '01/',
            'title' => 'Domestic PNG Updated',
            'card_heading' => 'Updated card headline text',
            'badges' => 'Fast, Reliable, Economical',
            'description' => 'Updated description text for testing.',
            'button_text' => 'Get Connected',
            'button_url' => '#apply',
            'order' => 1,
            'is_active' => '1',
        ]);

        $response->assertRedirect('/admin/services');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'title' => 'Domestic PNG Updated',
            'button_text' => 'Get Connected',
        ]);
    }

    public function test_admin_can_create_a_service_via_ajax(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->postJson('/admin/services', [
            'number_label' => '08/',
            'title' => 'Compressed Bio-Gas (CBG)',
            'card_heading' => 'Sustainable automotive fuel from organic waste',
            'badges' => 'Green Energy, Carbon Neutral',
            'description' => 'CBG generation for city bus networks.',
            'button_text' => 'Inquire',
            'button_url' => '#contact',
            'order' => 8,
            'is_active' => '1',
            'image' => UploadedFile::fake()->image('cbg.png', 800, 600),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'New service added successfully!',
        ]);

        $this->assertDatabaseHas('services', [
            'title' => 'Compressed Bio-Gas (CBG)',
            'order' => 8,
        ]);
    }

    public function test_admin_can_update_a_service_via_ajax(): void
    {
        $service = Service::firstOrFail();

        $response = $this->actingAs($this->admin)->putJson('/admin/services/'.$service->id, [
            'number_label' => '01/',
            'title' => 'Domestic PNG Modernized',
            'card_heading' => 'Updated via AJAX call',
            'badges' => 'Reliable, Modern, Safe',
            'description' => 'Description updated with SweetAlert confirmation.',
            'button_text' => 'Know More',
            'button_url' => '#contact',
            'order' => 1,
            'is_active' => '1',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'title' => 'Domestic PNG Modernized',
        ]);
    }

    public function test_ajax_validation_error_returns_unprocessable_status(): void
    {
        $response = $this->actingAs($this->admin)->postJson('/admin/services', [
            // missing required fields
            'title' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title', 'number_label', 'card_heading', 'description', 'image']);
    }

    public function test_admin_can_toggle_service_active_status(): void
    {
        $service = Service::firstOrFail();
        $initialStatus = $service->is_active;

        $response = $this->actingAs($this->admin)->post('/admin/services/'.$service->id.'/toggle');

        $response->assertRedirect('/admin/services');
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'is_active' => ! $initialStatus,
        ]);
    }

    public function test_admin_can_delete_a_service(): void
    {
        $service = Service::create([
            'number_label' => '99/',
            'title' => 'Temporary Service',
            'slug' => 'temporary-service',
            'card_heading' => 'Temporary card heading',
            'badges' => ['Temp'],
            'image_path' => 'images/assets/temporary.png',
            'description' => 'Temporary description',
            'order' => 99,
            'is_active' => false,
        ]);

        $response = $this->actingAs($this->admin)->delete('/admin/services/'.$service->id);

        $response->assertRedirect('/admin/services');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('services', [
            'id' => $service->id,
        ]);
    }

    public function test_admin_can_delete_a_service_via_ajax(): void
    {
        $service = Service::create([
            'number_label' => '99/',
            'title' => 'Temporary Service for Ajax Delete',
            'slug' => 'temporary-service-ajax-delete',
            'card_heading' => 'Temporary card heading',
            'badges' => ['Temp'],
            'image_path' => 'images/assets/temporary.png',
            'description' => 'Temporary description',
            'order' => 99,
            'is_active' => false,
        ]);

        $response = $this->actingAs($this->admin)->deleteJson('/admin/services/'.$service->id);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseMissing('services', [
            'id' => $service->id,
        ]);
    }
}
