<?php

namespace Tests\Feature;

use App\Enums\NoticeBadge;
use App\Enums\NoticeType;
use App\Models\Notice;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminNoticeTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->admin = User::where('email', 'admin@agpl.in')->firstOrFail();
    }

    public function test_guest_is_redirected_to_login_when_accessing_notices(): void
    {
        $response = $this->get('/admin/notices');

        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_view_notices_list_with_alpine_drawer_bindings(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/notices');

        $response->assertStatus(200);
        $response->assertSee('x-data="noticeManager', false);
        $response->assertSee('openEditDrawer', false);
        $response->assertSee('openCreateDrawer', false);
        $response->assertSee('Quarterly Safety Audit');
        $response->assertSee('NEW');
    }

    public function test_admin_can_create_a_new_notice_via_ajax(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->postJson('/admin/notices', [
            'title' => 'Annual General Meeting 2026',
            'description' => 'AGPL shareholders and directors annual performance conference in Itanagar.',
            'date_text' => '15 Nov 2026 - 09:30 AM',
            'type' => NoticeType::Event->value,
            'badge' => NoticeBadge::Upcoming->value,
            'order' => 5,
            'is_active' => '1',
            'icon' => UploadedFile::fake()->image('agm_icon.png', 64, 64),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'New notice / event added successfully!',
        ]);

        $this->assertDatabaseHas('notices', [
            'title' => 'Annual General Meeting 2026',
            'type' => NoticeType::Event->value,
            'badge' => NoticeBadge::Upcoming->value,
            'order' => 5,
            'is_active' => true,
        ]);
    }

    public function test_admin_can_update_a_notice_via_ajax(): void
    {
        $notice = Notice::firstOrFail();

        $response = $this->actingAs($this->admin)->putJson('/admin/notices/'.$notice->id, [
            'title' => 'Updated Safety Circular 2026',
            'description' => 'Mandatory pipeline inspection guidelines across all districts.',
            'type' => NoticeType::Notice->value,
            'badge' => NoticeBadge::Important->value,
            'order' => 1,
            'is_active' => '1',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Notice / event updated successfully!',
        ]);

        $this->assertDatabaseHas('notices', [
            'id' => $notice->id,
            'title' => 'Updated Safety Circular 2026',
            'badge' => NoticeBadge::Important->value,
        ]);
    }

    public function test_admin_can_toggle_notice_status_via_ajax(): void
    {
        $notice = Notice::firstOrFail();
        $initialStatus = $notice->is_active;

        $response = $this->actingAs($this->admin)->postJson('/admin/notices/'.$notice->id.'/toggle');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'is_active' => ! $initialStatus,
        ]);

        $this->assertDatabaseHas('notices', [
            'id' => $notice->id,
            'is_active' => ! $initialStatus,
        ]);
    }

    public function test_admin_can_delete_a_notice_via_ajax(): void
    {
        $notice = Notice::firstOrFail();

        $response = $this->actingAs($this->admin)->deleteJson('/admin/notices/'.$notice->id);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseMissing('notices', [
            'id' => $notice->id,
        ]);
    }

    public function test_smart_icon_url_fallback_based_on_notice_type(): void
    {
        $eventNotice = Notice::create([
            'title' => 'Event Without Custom Icon',
            'description' => 'Testing fallback icon for corporate event',
            'type' => NoticeType::Event,
            'badge' => NoticeBadge::Event,
            'icon_path' => null,
            'order' => 10,
            'is_active' => true,
        ]);

        $newsNotice = Notice::create([
            'title' => 'News Without Custom Icon',
            'description' => 'Testing fallback icon for news release',
            'type' => NoticeType::News,
            'badge' => NoticeBadge::New,
            'icon_path' => null,
            'order' => 11,
            'is_active' => true,
        ]);

        $this->assertStringContainsString('Town Hall Meeting.png', $eventNotice->icon_url);
        $this->assertStringContainsString('New Compliance Guidelines.png', $newsNotice->icon_url);
    }

    public function test_ajax_notice_validation_error_returns_unprocessable_status(): void
    {
        $response = $this->actingAs($this->admin)->postJson('/admin/notices', [
            'title' => '',
            'description' => '',
            'type' => 'invalid-type-enum',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title', 'description', 'type']);
    }

    public function test_admin_notices_displays_error_component_when_controller_catches_error(): void
    {
        $view = $this->actingAs($this->admin)->view('admin.notices.index', [
            'notices' => collect(),
            'error' => 'Simulated database failure for notices',
            'errorDetails' => 'Connection timeout to MySQL',
            'types' => NoticeType::cases(),
            'badges' => NoticeBadge::cases(),
        ]);

        $view->assertSee('Failed to Load Notices');
        $view->assertSee('View Technical Error');
        $view->assertSee('Connection timeout to MySQL');
    }
}
