<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

class AdminErrorComponentTest extends TestCase
{
    public function test_admin_error_state_component_renders_default_content(): void
    {
        $rendered = Blade::render('<x-admin.error-state />');

        $this->assertStringContainsString('Something went wrong', $rendered);
        $this->assertStringContainsString('Refresh Page', $rendered);
        $this->assertStringContainsString('Back to Dashboard', $rendered);
    }

    public function test_admin_error_state_component_renders_custom_props(): void
    {
        $rendered = Blade::render(
            '<x-admin.error-state title="Database Connection Failed" message="Please check MySQL service." details="Connection refused on port 3306" />'
        );

        $this->assertStringContainsString('Database Connection Failed', $rendered);
        $this->assertStringContainsString('Please check MySQL service.', $rendered);
        $this->assertStringContainsString('Connection refused on port 3306', $rendered);
    }

    public function test_admin_error_state_component_renders_compact_banner(): void
    {
        $rendered = Blade::render(
            '<x-admin.error-state compact title="Warning" message="Service synchronization is delayed." />'
        );

        $this->assertStringContainsString('Warning', $rendered);
        $this->assertStringContainsString('Service synchronization is delayed.', $rendered);
        $this->assertStringContainsString('role="alert"', $rendered);
    }

    public function test_admin_error_alias_component_renders_properly(): void
    {
        $rendered = Blade::render(
            '<x-admin.error title="Section Error" message="Could not fetch analytics data." />'
        );

        $this->assertStringContainsString('Section Error', $rendered);
        $this->assertStringContainsString('Could not fetch analytics data.', $rendered);
    }
}
