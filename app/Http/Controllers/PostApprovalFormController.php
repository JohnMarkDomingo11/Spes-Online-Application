<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostApprovalFormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ─── Helper: get approved application for current user ───────────────────
    private function getApprovedApp(): ?Application
    {
        return Application::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->orderByDesc('created_at')
            ->first();
    }

    // ─── FORM 2 ───────────────────────────────────────────────────────────────
    public function showForm2()
    {
        $application = $this->getApprovedApp();
        if (! $application) {
            return redirect()->route('applications.myApplication')
                ->with('error', 'Your application must be approved by the admin before you can complete Form 2.');
        }

        return view('application.applications.form2', compact('application'));
    }

    public function storeForm2(Request $request)
    {
        $application = $this->getApprovedApp();
        if (! $application) {
            return redirect()->route('applications.myApplication')
                ->with('error', 'Your application must be approved by the admin before you can submit Form 2.');
        }

        $validated = $request->validate([
            'f2_control_no'           => 'nullable|string|max:50',
            'f2_place_of_birth'       => 'required|string|max:200',
            'f2_citizenship'          => 'required|string|max:100',
            'f2_email'                => 'required|email|max:255',
            'f2_social_media'         => 'nullable|string|max:200',
            'f2_gsis_beneficiary'     => 'nullable|string|max:200',
            'f2_present_address'      => 'required|string|max:300',
            'f2_permanent_address'    => 'required|string|max:300',
            'f2_applicant_category'   => 'required|in:STUDENT,ALS STUDENT,OUT OF SCHOOL YOUTH',
            'f2_special_skills'       => 'nullable|string|max:300',
            'f2_father_occupation'    => 'nullable|string|max:200',
            'f2_mother_occupation'    => 'nullable|string|max:200',
            'f2_other_info'           => 'nullable|string|max:1000',
            'f2_consent_accepted'     => 'required|accepted',
            'f2_checklist'            => 'nullable|array',
            // nested education rows
            'education'               => 'nullable|array',
            'spes_history'            => 'nullable|array',
            'parent_status_details'   => 'nullable|array',
        ]);

        $application->update([
            'f2_control_no'           => $validated['f2_control_no'] ?? null,
            'f2_place_of_birth'       => $validated['f2_place_of_birth'] ?? null,
            'f2_citizenship'          => $validated['f2_citizenship'] ?? null,
            'f2_email'                => $validated['f2_email'] ?? null,
            'f2_social_media'         => $validated['f2_social_media'] ?? null,
            'f2_gsis_beneficiary'     => $validated['f2_gsis_beneficiary'] ?? null,
            'f2_present_address'      => $validated['f2_present_address'] ?? null,
            'f2_permanent_address'    => $validated['f2_permanent_address'] ?? null,
            'f2_applicant_category'   => $validated['f2_applicant_category'] ?? null,
            'f2_special_skills'       => $validated['f2_special_skills'] ?? null,
            'f2_father_occupation'    => $validated['f2_father_occupation'] ?? null,
            'f2_mother_occupation'    => $validated['f2_mother_occupation'] ?? null,
            'f2_other_info'           => $validated['f2_other_info'] ?? null,
            'f2_consent_accepted'     => isset($validated['f2_consent_accepted']) ? (bool)$validated['f2_consent_accepted'] : true,
            'f2_checklist'            => json_encode($request->input('f2_checklist', [])),
            'f2_education_history'    => json_encode($request->input('education', [])),
            'f2_spes_history'         => json_encode($request->input('spes_history', [])),
            'f2_parent_status_details'=> implode(',', $request->input('parent_status_details', [])),
            'forms_step'              => max($application->forms_step, 1),
        ]);

        return redirect()->route('applications.myApplication')
            ->with('success', 'Form 2 (Application Form) saved successfully!');
    }

    // ─── FORM 3 ───────────────────────────────────────────────────────────────
    // REMOVED: Form 3 and Form 4 have been removed from the application process
}

