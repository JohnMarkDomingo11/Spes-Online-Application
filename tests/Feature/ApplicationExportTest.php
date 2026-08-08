<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationExportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_export_application_pdf()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $application = Application::factory()->create([
            'form_data' => [
                'surname' => 'Dela Cruz',
                'first_name' => 'Juan',
            ],
        ]);

        $this->actingAs($admin);

        $response = $this->get(route('admin.applications.export', $application));

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
        // PDF payload is binary; ensure it has the PDF header and is non‑empty
        $content = $response->getContent();
        $this->assertStringStartsWith('%PDF', $content);
        $this->assertTrue(strlen($content) > 1000, 'PDF should be at least 1KB');
    }

    /** @test */
    public function non_admin_cannot_export()
    {
        $user = User::factory()->create(['role' => 'user']);
        $application = Application::factory()->create();

        $this->actingAs($user);

        // middleware redirects back to dashboard with error message
        $this->get(route('admin.applications.export', $application))
             ->assertRedirect('/dashboard')
             ->assertSessionHas('error');
    }
}
