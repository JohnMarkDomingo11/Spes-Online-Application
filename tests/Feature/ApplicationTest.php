<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_submit_application()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('applications.store'), $this->validApplicationPayload());

        $response->assertRedirect(route('applications.myApplication'));
        $this->assertDatabaseHas('applications', [
            'user_id' => $user->id,
            'full_name' => 'Juan Dela Cruz',
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function user_can_reapply_after_application_is_denied()
    {
        $user = User::factory()->create();
        $application = Application::factory()->for($user)->create([
            'status' => 'denied',
            'admin_comment' => 'Please update your information.',
            'forms_step' => 2,
        ]);

        $this->actingAs($user);

        $response = $this->put(route('applications.update'), $this->validApplicationPayload([
            'full_name' => 'Juan Updated',
        ]));

        $response->assertRedirect(route('applications.myApplication'));

        $application->refresh();
        $this->assertSame('pending', $application->status);
        $this->assertNull($application->admin_comment);
        $this->assertSame(0, $application->forms_step);
        $this->assertSame('Juan Updated', $application->full_name);
    }

    /** @test */
    public function admin_can_approve_and_deny_application()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $application = Application::factory()->create();
        $applicant = $application->user;

        $this->actingAs($admin);
        $this->post(route('admin.applications.approve', $application))
             ->assertRedirect();
        $this->assertEquals('approved', $application->fresh()->status);

        $this->post(route('admin.applications.deny', $application))
             ->assertRedirect();
        $this->assertEquals('denied', $application->fresh()->status);
    }

    private function validApplicationPayload(array $overrides = []): array
    {
        return array_merge([
            'full_name' => 'Juan Dela Cruz',
            'sex' => 'Male',
            'birthday' => now()->subYears(20)->format('Y-m-d'),
            'age' => 20,
            'barangay' => 'Bical',
            'civil_status' => 'Single',
            'parent_status' => 'Both Parents',
            'education' => 'College (Currently Enrolled)',
            'spes_status' => 'new',
            'mother_name' => 'Maria Dela Cruz',
            'father_guardian_name' => 'Pedro Dela Cruz',
            'contact_no' => '09123456789',
            'messenger' => 'juan.dela.cruz',
        ], $overrides);
    }
}
