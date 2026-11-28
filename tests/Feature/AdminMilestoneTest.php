<?php

namespace Tests\Feature;

use App\Models\Milestone;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminMilestoneTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->admin = User::where('email', 'admin@agpl.in')->firstOrFail();
    }

    public function test_guest_is_redirected_to_login_when_accessing_milestones(): void
    {
        $response = $this->get('/admin/milestones');

        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_view_milestones_list_with_alpine_drawer_bindings(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/milestones');

        $response->assertStatus(200);
        $response->assertSee('x-data="milestoneManager', false);
        $response->assertSee('openEditDrawer', false);
        $response->assertSee('openCreateDrawer', false);
        $response->assertSee('BPCL Board approves bid strategy');
        $response->assertSee('Dec 2023');
    }

    public function test_admin_can_create_a_new_milestone_via_ajax(): void
    {
        $response = $this->actingAs($this->admin)->postJson('/admin/milestones', [
            'period' => 'Sep 2026',
            'title' => 'First Mother Station breaking ground in Itanagar',
            'icon' => 'map-pin',
            'is_highlighted' => '1',
            'order' => 9,
            'is_active' => '1',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'New key milestone added successfully!',
        ]);

        $this->assertDatabaseHas('milestones', [
            'period' => 'Sep 2026',
            'title' => 'First Mother Station breaking ground in Itanagar',
            'icon' => 'map-pin',
            'is_highlighted' => true,
            'is_active' => true,
        ]);
    }

    public function test_admin_can_update_a_milestone_via_ajax(): void
    {
        $milestone = Milestone::firstOrFail();

        $response = $this->actingAs($this->admin)->putJson("/admin/milestones/{$milestone->id}", [
            'period' => 'Jan 2024',
            'title' => 'Updated Strategy & Authorisation Phase',
            'icon' => 'gavel',
            'is_highlighted' => '0',
            'order' => 1,
            'is_active' => '1',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Milestone updated successfully!',
        ]);

        $this->assertDatabaseHas('milestones', [
            'id' => $milestone->id,
            'period' => 'Jan 2024',
            'title' => 'Updated Strategy & Authorisation Phase',
            'icon' => 'gavel',
            'is_highlighted' => false,
        ]);
    }

    public function test_admin_can_toggle_milestone_active_status_via_ajax(): void
    {
        $milestone = Milestone::firstOrFail();
        $this->assertTrue((bool) $milestone->is_active);

        $response = $this->actingAs($this->admin)->postJson("/admin/milestones/{$milestone->id}/toggle");

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'is_active' => false,
        ]);

        $this->assertFalse((bool) $milestone->fresh()->is_active);
    }

    public function test_admin_can_delete_a_milestone_via_ajax(): void
    {
        $milestone = Milestone::create([
            'period' => 'Temporary Period',
            'title' => 'To be deleted milestone',
            'icon' => 'settings',
            'order' => 99,
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->deleteJson("/admin/milestones/{$milestone->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Milestone deleted successfully!',
        ]);

        $this->assertDatabaseMissing('milestones', [
            'id' => $milestone->id,
        ]);
    }

    public function test_ajax_milestone_validation_error_returns_unprocessable_status(): void
    {
        $response = $this->actingAs($this->admin)->postJson('/admin/milestones', [
            'period' => '',
            'title' => '',
            'icon' => 'invalid-icon-key',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['period', 'title', 'icon']);
    }

    public function test_admin_can_upload_custom_icon_for_milestone(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->postJson('/admin/milestones', [
            'period' => 'Nov 2026',
            'title' => 'Custom icon testing milestone event',
            'icon' => 'document',
            'order' => 10,
            'is_active' => '1',
            'custom_icon' => UploadedFile::fake()->image('custom_icon.png', 100, 100),
        ]);

        $response->assertStatus(200);

        $milestone = Milestone::where('title', 'Custom icon testing milestone event')->firstOrFail();
        $this->assertNotNull($milestone->custom_icon_path);
        Storage::disk('public')->assertExists($milestone->custom_icon_path);
    }
}
