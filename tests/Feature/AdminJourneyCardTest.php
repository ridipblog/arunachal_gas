<?php

namespace Tests\Feature;

use App\Models\JourneyCard;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminJourneyCardTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->admin = User::where('email', 'admin@agpl.in')->firstOrFail();
    }

    public function test_guest_is_redirected_to_login_when_accessing_journey_cards(): void
    {
        $response = $this->get('/admin/journey-cards');

        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_view_journey_cards_list_with_alpine_drawer_bindings(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/journey-cards');

        $response->assertStatus(200);
        $response->assertSee('x-data="journeyManager', false);
        $response->assertSee('openEditDrawer', false);
        $response->assertSee('openCreateDrawer', false);
        $response->assertSee('Energy Infrastructure');
        $response->assertSee('People Behind Progress');
    }

    public function test_admin_can_create_a_new_journey_card_via_ajax(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->postJson('/admin/journey-cards', [
            'title' => 'Green Energy Pioneer',
            'description' => 'Solar and bio-gas hybrid projects for remote hill villages.',
            'order' => 1,
            'is_active' => '1',
            'image' => UploadedFile::fake()->image('green_pioneer.jpg', 1200, 800),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'New journey card added successfully!',
        ]);

        $this->assertDatabaseHas('journey_cards', [
            'title' => 'Green Energy Pioneer',
            'order' => 1,
            'is_active' => true,
        ]);
    }

    public function test_admin_can_update_a_journey_card_via_ajax(): void
    {
        $card = JourneyCard::firstOrFail();

        $response = $this->actingAs($this->admin)->putJson('/admin/journey-cards/'.$card->id, [
            'title' => 'Advanced Gas Infrastructure 2026',
            'description' => 'Expanding steel networks through rugged mountain ranges.',
            'order' => 1,
            'is_active' => '1',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Journey card updated successfully!',
        ]);

        $this->assertDatabaseHas('journey_cards', [
            'id' => $card->id,
            'title' => 'Advanced Gas Infrastructure 2026',
        ]);
    }

    public function test_admin_can_toggle_journey_card_status_via_ajax(): void
    {
        $card = JourneyCard::firstOrFail();
        $initialStatus = $card->is_active;

        $response = $this->actingAs($this->admin)->postJson('/admin/journey-cards/'.$card->id.'/toggle');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'is_active' => ! $initialStatus,
        ]);

        $this->assertDatabaseHas('journey_cards', [
            'id' => $card->id,
            'is_active' => ! $initialStatus,
        ]);
    }

    public function test_admin_can_delete_a_journey_card_via_ajax(): void
    {
        $card = JourneyCard::firstOrFail();

        $response = $this->actingAs($this->admin)->deleteJson('/admin/journey-cards/'.$card->id);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseMissing('journey_cards', [
            'id' => $card->id,
        ]);
    }

    public function test_ajax_journey_card_validation_error_returns_unprocessable_status(): void
    {
        $response = $this->actingAs($this->admin)->postJson('/admin/journey-cards', [
            'title' => '',
            'description' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title', 'description', 'image']);
    }

    public function test_admin_journey_cards_displays_error_component_when_controller_catches_error(): void
    {
        $view = $this->actingAs($this->admin)->view('admin.journey.index', [
            'cards' => collect(),
            'error' => 'Simulated database failure for journey',
            'errorDetails' => 'Connection timeout to MySQL',
        ]);

        $view->assertSee('Failed to Load Journey Cards');
        $view->assertSee('View Technical Error');
        $view->assertSee('Connection timeout to MySQL');
    }
}
