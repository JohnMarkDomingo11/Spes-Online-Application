
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPES Form 2 Application Form</title>
    <style>
        body { font-family: "Arial Narrow", Arial, sans-serif; font-size: 11px; display: flex; justify-content: center; background: #999; padding: 20px; }
        .document { width: 8.5in; background: white; padding: 0.5in; box-sizing: border-box; border: 1px solid #000; }
        /* ... keep the rest of the CSS unchanged ... */
    </style>
</head>
<body>
<div class="document">
    <div class="spes-form-id">SPES Form 2</div>
    <div class="header-section">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e4/Seal_of_the_Department_of_Labor_and_Employment_%28DOLE%29.svg" class="logo" alt="DOLE Logo">
        <div class="header-text">
            REPUBLIC OF THE PHILIPPINES<br>
            <strong>DEPARTMENT OF LABOR AND EMPLOYMENT</strong><br>
            Regional Office No. _____________<br>
            <strong>PUBLIC EMPLOYMENT SERVICE OFFICE</strong><br><br>
            City/Municipality/Province<br>
            <strong>SPECIAL PROGRAM FOR EMPLOYMENT OF STUDENTS (SPES)</strong><br>
            (RA 7323, as amended by RAs 9547 and 10917)
        </div>
        <img src="https://upload.wikimedia.org/wikipedia/commons/0/09/Public_Employment_Service_Office_%28PESO%29_logo.png" class="logo" alt="PESO Logo">
    </div>

    <div class="title">APPLICATION FORM</div>
    <div class="control-no">Control No.: {{ $application->id }}</div>

    <table>
        <tr>
            <td colspan="2"><span class="label">SURNAME</span><br>{{ $application->form_data['surname'] ?? $application->applicant_name }}</td>
            <td colspan="2"><span class="label">FIRST NAME</span><br>{{ $application->form_data['first_name'] ?? '' }}</td>
            <td colspan="2"><span class="label">MIDDLE NAME</span><br>{{ $application->form_data['middle_name'] ?? '' }}</td>
            <td colspan="2"><span class="label">GSIS BENEFICIARY/RELATIONSHIP</span><br>{{ $application->form_data['gsis_relationship'] ?? '' }}</td>
            <td rowspan="4" style="padding: 0; width: 140px;">
                <div class="photo-box">
                    @if($application->photo_url)
                        <img src="{{ $application->photo_url }}" style="max-width:100%;max-height:100%;">
                    @else
                        Passport Size Picture<br>(3.5cm x 4.5 cm)
                    @endif
                </div>
            </td>
        </tr>
        <!-- continue substituting other fields as needed -->
        <!-- for brevity only a few fields are shown -->
    </table>

    <!-- rest of template remains the same; you can inject more fields if stored -->
</div>
</body>
</html>
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
            'applicant_name' => 'Juan Dela Cruz',
            'first_name' => 'Juan',
            'surname' => 'Dela Cruz',
        ]);

        $this->actingAs($admin);

        $response = $this->get(route('admin.applications.export', $application));

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
        $this->assertStringContainsString('Juan Dela Cruz', $response->getContent());
    }

    /** @test */
    public function non_admin_cannot_export()
    {
        $user = User::factory()->create(['role' => 'user']);
        $application = Application::factory()->create();

        $this->actingAs($user);

        $this->get(route('admin.applications.export', $application))
             ->assertStatus(403);
    }
}