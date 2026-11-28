<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_page(): void
    {
        $response = $this->get('/admin/services');

        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_view_login_page(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('Admin Login');
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $admin = User::create([
            'name' => 'AGPL Administrator',
            'email' => 'admin@agpl.in',
            'password' => Hash::make('password123'),
            'is_admin' => true,
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@agpl.in',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/admin/services');
        $this->assertAuthenticatedAs($admin);
    }

    public function test_authenticated_admin_can_access_services_manager(): void
    {
        $this->seed(DatabaseSeeder::class);
        $admin = User::where('email', 'admin@agpl.in')->first();

        $response = $this->actingAs($admin)->get('/admin/services');

        $response->assertStatus(200);
        $response->assertSee('Active Service Showcase');
        $response->assertSee('Domestic PNG');
    }

    public function test_admin_can_update_service(): void
    {
        $this->seed(DatabaseSeeder::class);
        $admin = User::where('email', 'admin@agpl.in')->first();
        $service = Service::first();

        $response = $this->actingAs($admin)->put("/admin/services/{$service->id}", [
            'number_label' => '01/',
            'title' => 'Domestic PNG Network',
            'card_heading' => 'Updated heading for test',
            'badges' => 'Safe, Reliable, Eco-Friendly',
            'description' => 'Updated domestic piped gas description.',
            'button_text' => 'Learn More',
            'button_url' => '#contact',
            'order' => 1,
            'is_active' => true,
        ]);

        $response->assertRedirect('/admin/services');
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'title' => 'Domestic PNG Network',
        ]);
    }

    public function test_admin_can_deactivate_service_status(): void
    {
        $this->seed(DatabaseSeeder::class);
        $admin = User::where('email', 'admin@agpl.in')->first();
        $service = Service::first();

        // Send update with is_active = 0 (unchecked)
        $response = $this->actingAs($admin)->put("/admin/services/{$service->id}", [
            'number_label' => $service->number_label,
            'title' => $service->title,
            'card_heading' => $service->card_heading,
            'description' => $service->description,
            'is_active' => '0',
        ]);

        $response->assertRedirect('/admin/services');
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'is_active' => false,
        ]);

        // Toggle back using toggle endpoint
        $toggleResponse = $this->actingAs($admin)->post("/admin/services/{$service->id}/toggle");
        $toggleResponse->assertRedirect('/admin/services');
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'is_active' => true,
        ]);
    }
}
