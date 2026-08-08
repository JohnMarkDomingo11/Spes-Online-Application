@extends('layouts.admin')

@section('title', 'Forms — '.$application->full_name)
@section('page-title', 'Application Forms')
@section('page-sub', $application->ref_id)

@section('content')

<div style="margin-bottom:16px;display:flex;gap:10px;justify-content:space-between;align-items:center;">
    <a href="{{ route('admin.applications.show', $application) }}" class="btn btn-outline btn-sm">
        <i class="fa-solid fa-arrow-left"></i> Back to Application
    </a>
    @if($application->forms_step >= 1)
        <button onclick="window.print()" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-download"></i> Download Form 2 (PDF)
        </button>
    @endif
</div>

@if($application->forms_step >= 1)
    {{-- Official SPES Form 2 Template --}}
    <div class="card" style="margin-bottom:20px;max-width:900px;margin-left:auto;margin-right:auto;">
        <div style="padding:40px;background:white;font-family:'Times New Roman',Times,serif;">
            
            {{-- Header --}}
            <div style="text-align:center;margin-bottom:20px;border-bottom:3px solid #004d40;padding-bottom:15px;">
                <div style="font-weight:bold;font-size:11px;margin-bottom:8px;">REPUBLIC OF THE PHILIPPINES<br>DEPARTMENT OF LABOR AND EMPLOYMENT<br>REGIONAL OFFICE NO. ___<br>Public Employment Service Office</div>
                <div style="font-weight:bold;font-size:13px;margin:15px 0;color:#004d40;">SPECIAL PROGRAM FOR EMPLOYMENT OF STUDENTS<br>(RA 7323, as amended by RAs 5547 and 10917)</div>
                <div style="font-weight:bold;font-size:14px;color:#004d40;">APPLICATION FORM</div>
                <div style="font-size:9px;margin-top:8px;text-align:right;">SPES Form 2</div>
            </div>

            {{-- Control No. --}}
            <div style="margin-bottom:15px;font-size:11px;">
                <strong>Control No.:</strong> {{ $application->f2_control_no ?? '_______________' }}
            </div>

            {{-- Consent & Privacy Notice --}}
            <div style="margin-bottom:15px;font-size:10px;border:1px solid #333;padding:10px;">
                <div style="font-weight:bold;margin-bottom:8px;">Consent and Data Privacy Notice:</div>
                <div style="line-height:1.4;text-align:justify;">
                    The information that you provide herein will be used by the DOLE to determine your eligibility to the Special Program for Employment of Students (SPES), facilitate job placement, and process projects. Your information may be shared with partners/employers and national government agencies for purposes of program implementation and data quality verification. By continuing, you signify your acceptance of these terms.
                </div>
            </div>

            {{-- Checklist of Documentary Requirements --}}
            <div style="margin-bottom:15px;font-size:10px;">
                <div style="font-weight:bold;margin-bottom:8px;">Checklist of Documentary Requirements:</div>
                <div style="margin-left:20px;line-height:1.6;">
                    <div>☐ Original copy of Certificate of Eligibility OR any valid ID (GSIS, SSS, Driver's License) issued not more than 10 years old; and</div>
                    <div>☐ Photocopy of the original identification documents OR certification issued by BIR that the photocopy of valid SSS card is for authentication purposes only</div>
                    <div style="margin-top:8px;font-weight:bold;">FOR STUDENT'S any of the following, in addition to requirements nos. 1 and 2:</div>
                    <div>☐ A photocopy of school records or report card for such grade or with an explanation on its absence in case of previous school OR</div>
                    <div>☐ Certification from School Register by the School Registrar as to the last grade, immediately preceding enrollment if grades are still not available</div>
                    <div style="margin-top:8px;font-weight:bold;">FOR OUT-OF-SCHOOL YOUTH, in addition to requirements nos. 1 and 2:</div>
                    <div>☐ Original copy of Certification of OSY issued by DepEd/DSWD or the authorized Barangay Official where the OSY status given</div>
                </div>
            </div>

            {{-- Student/Applicant's Information --}}
            <div style="margin-bottom:15px;font-size:11px;">
                <div style="font-weight:bold;margin-bottom:10px;border-bottom:2px solid #333;padding-bottom:5px;">Student / Applicant's Information:</div>
                
                {{-- Row 1: Name, Place of Birth, Date of Birth --}}
                <table style="width:100%;margin-bottom:8px;font-size:10px;">
                    <tr>
                        <td style="width:40%;border-bottom:1px solid #000;padding:4px;">
                            <strong>NAME:</strong> {{ $application->full_name }}<br>
                            <span style="font-size:9px;">(Last Name)</span>
                        </td>
                        <td style="width:5%;"></td>
                        <td style="width:30%;border-bottom:1px solid #000;padding:4px;">
                            <strong>PLACE OF BIRTH:</strong> {{ $application->f2_place_of_birth }}<br>
                            <span style="font-size:9px;">(Name of City/Municipality)</span>
                        </td>
                        <td style="width:5%;"></td>
                        <td style="width:20%;border-bottom:1px solid #000;padding:4px;">
                            <strong>DATE OF BIRTH:</strong><br>
                            {{ $application->birthday->format('m/d/Y') }}<br>
                            <span style="font-size:9px;">(MM/DD/YYYY)</span>
                        </td>
                    </tr>
                </table>

                {{-- Row 2: Sex, Citizenship, Age, Email --}}
                <table style="width:100%;margin-bottom:8px;font-size:10px;">
                    <tr>
                        <td style="width:15%;border-bottom:1px solid #000;padding:4px;text-align:center;">
                            <strong>SEX:</strong><br>{{ $application->sex }}
                        </td>
                        <td style="width:5%;"></td>
                        <td style="width:20%;border-bottom:1px solid #000;padding:4px;">
                            <strong>CITIZENSHIP:</strong><br>{{ $application->f2_citizenship }}
                        </td>
                        <td style="width:5%;"></td>
                        <td style="width:15%;border-bottom:1px solid #000;padding:4px;text-align:center;">
                            <strong>AGE:</strong><br>{{ $application->age }}
                        </td>
                        <td style="width:5%;"></td>
                        <td style="width:35%;border-bottom:1px solid #000;padding:4px;">
                            <strong>EMAIL ADDRESS:</strong><br>{{ $application->f2_email }}
                        </td>
                    </tr>
                </table>

                {{-- Row 3: Status, Citizenship #, Social Media, GSIS/SSS --}}
                <table style="width:100%;margin-bottom:8px;font-size:10px;">
                    <tr>
                        <td style="width:20%;border-bottom:1px solid #000;padding:4px;">
                            <strong>STATUS:</strong><br>{{ $application->civil_status }}
                        </td>
                        <td style="width:5%;"></td>
                        <td style="width:20%;border-bottom:1px solid #000;padding:4px;">
                            <strong>GSIS/SSS/BENEFICIARY:</strong><br>{{ $application->f2_gsis_beneficiary ?? '—' }}
                        </td>
                        <td style="width:5%;"></td>
                        <td style="width:50%;border-bottom:1px solid #000;padding:4px;">
                            <strong>SOCIAL MEDIA ACCOUNT:</strong><br>{{ $application->f2_social_media ?? '—' }}
                        </td>
                    </tr>
                </table>

                {{-- Row 4: Addresses --}}
                <table style="width:100%;margin-bottom:8px;font-size:10px;">
                    <tr>
                        <td style="width:48%;border-bottom:1px solid #000;padding:4px;">
                            <strong>PRESENT ADDRESS:</strong><br>{{ $application->f2_present_address }}<br>
                            <span style="font-size:9px;">(Barangay, City/Municipality, Province)</span>
                        </td>
                        <td style="width:4%;"></td>
                        <td style="width:48%;border-bottom:1px solid #000;padding:4px;">
                            <strong>PERMANENT ADDRESS:</strong><br>{{ $application->f2_permanent_address }}<br>
                            <span style="font-size:9px;">(Barangay, City/Municipality, Province)</span>
                        </td>
                    </tr>
                </table>

                {{-- Row 5: Contact & Category --}}
                <table style="width:100%;margin-bottom:12px;font-size:10px;">
                    <tr>
                        <td style="width:25%;border-bottom:1px solid #000;padding:4px;">
                            <strong>CONTACT NUMBER:</strong><br>{{ $application->contact_no }}
                        </td>
                        <td style="width:5%;"></td>
                        <td style="width:25%;border-bottom:1px solid #000;padding:4px;">
                            <strong>APPLICANT'S CATEGORY:</strong><br>{{ $application->f2_applicant_category }}
                        </td>
                        <td style="width:5%;"></td>
                        <td style="width:40%;border-bottom:1px solid #000;padding:4px;">
                            <strong>SPECIAL SKILLS:</strong><br>{{ $application->f2_special_skills ?? '—' }}
                        </td>
                    </tr>
                </table>
            </div>

            {{-- Education History Table --}}
            @php
                $educationHistory = json_decode($application->f2_education_history, true) ?? [];
            @endphp
            <div style="margin-bottom:15px;font-size:10px;">
                <div style="font-weight:bold;margin-bottom:8px;">EDUCATIONAL ATTAINMENT:</div>
                <table style="width:100%;border-collapse:collapse;border:1px solid #000;font-size:9px;">
                    <thead>
                        <tr style="background:#f5f5f5;">
                            <th style="border:1px solid #000;padding:6px;text-align:center;font-weight:bold;">EDUCATION</th>
                            <th style="border:1px solid #000;padding:6px;text-align:center;font-weight:bold;">NAME OF SCHOOL</th>
                            <th style="border:1px solid #000;padding:6px;text-align:center;font-weight:bold;">COURSE / STRAND</th>
                            <th style="border:1px solid #000;padding:6px;text-align:center;font-weight:bold;">YEAR LEVEL</th>
                            <th style="border:1px solid #000;padding:6px;text-align:center;font-weight:bold;">DATE OF ATTENDANCE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($educationHistory as $edu)
                            <tr>
                                <td style="border:1px solid #000;padding:6px;">{{ $edu[0] ?? '—' }}</td>
                                <td style="border:1px solid #000;padding:6px;">{{ $edu[1] ?? '—' }}</td>
                                <td style="border:1px solid #000;padding:6px;">{{ $edu[2] ?? '—' }}</td>
                                <td style="border:1px solid #000;padding:6px;text-align:center;">{{ $edu[3] ?? '—' }}</td>
                                <td style="border:1px solid #000;padding:6px;text-align:center;">{{ $edu[4] ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td style="border:1px solid #000;padding:6px;text-align:center;">—</td>
                                <td style="border:1px solid #000;padding:6px;text-align:center;">—</td>
                                <td style="border:1px solid #000;padding:6px;text-align:center;">—</td>
                                <td style="border:1px solid #000;padding:6px;text-align:center;">—</td>
                                <td style="border:1px solid #000;padding:6px;text-align:center;">—</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Family Information --}}
            <div style="margin-bottom:15px;font-size:10px;">
                <div style="font-weight:bold;margin-bottom:8px;">FAMILY INFORMATION:</div>
                
                <table style="width:100%;margin-bottom:8px;">
                    <tr>
                        <td style="width:50%;border-bottom:1px solid #000;padding:4px;">
                            <strong>FATHER'S NAME AND CONTACT NO.:</strong><br>{{ $application->father_guardian_name }}
                        </td>
                        <td style="width:5%;"></td>
                        <td style="width:45%;border-bottom:1px solid #000;padding:4px;">
                            <strong>OCCUPATION:</strong><br>{{ $application->f2_father_occupation ?? '—' }}
                        </td>
                    </tr>
                </table>

                <table style="width:100%;margin-bottom:8px;">
                    <tr>
                        <td style="width:50%;border-bottom:1px solid #000;padding:4px;">
                            <strong>MOTHER'S NAME AND CONTACT NO.:</strong><br>{{ $application->mother_name }}
                        </td>
                        <td style="width:5%;"></td>
                        <td style="width:45%;border-bottom:1px solid #000;padding:4px;">
                            <strong>OCCUPATION:</strong><br>{{ $application->f2_mother_occupation ?? '—' }}
                        </td>
                    </tr>
                </table>
            </div>

            {{-- SPES History --}}
            @php
                $spesHistory = json_decode($application->f2_spes_history, true) ?? [];
            @endphp
            @if(count($spesHistory) > 0)
                <div style="margin-bottom:15px;font-size:10px;">
                    <div style="font-weight:bold;margin-bottom:8px;">SPES HISTORY:</div>
                    <ul style="margin:0;padding-left:20px;">
                        @foreach($spesHistory as $spes)
                            @if(is_array($spes) && !empty(array_filter($spes)))
                                <li>{{ implode(' - ', array_filter($spes)) }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Other Information --}}
            @if($application->f2_other_info)
                <div style="margin-bottom:15px;font-size:10px;">
                    <div style="font-weight:bold;margin-bottom:8px;">OTHER INFORMATION:</div>
                    <div style="border:1px solid #000;padding:10px;line-height:1.4;">
                        {{ $application->f2_other_info }}
                    </div>
                </div>
            @endif

            {{-- Submission Info --}}
            <div style="margin-top:20px;font-size:9px;border-top:1px solid #000;padding-top:10px;text-align:center;">
                <strong>Form Submitted:</strong> {{ $application->updated_at->format('F d, Y \a\t g:i A') }}<br>
                <strong>Reference ID:</strong> {{ $application->ref_id }}
            </div>

        </div>
    </div>
@else
    <div class="card">
        <div class="card-header">
            <h2><i class="fa-solid fa-file-pen"></i> SPES Form 2 — Application Form</h2>
        </div>
        <div class="card-body" style="text-align:center;color:var(--text-muted);padding:60px 20px;">
            <i class="fa-solid fa-lock" style="font-size:3rem;margin-bottom:16px;display:block;color:#ccc;"></i>
            <h3 style="margin:0 0 8px;color:var(--primary);">No Forms Submitted Yet</h3>
            <p style="margin:0;font-size:.95rem;">This applicant has not yet submitted any employment forms.</p>
        </div>
    </div>
@endif

{{-- Print Styles --}}
<style>
    @media print {
        body { 
            background:white !important; 
            margin:0;
            padding:0;
        }
        .btn { display:none !important; }
        .card { 
            box-shadow:none !important; 
            border:none !important; 
            page-break-inside:avoid;
            padding:0 !important;
        }
        .card-header { display:none !important; }
        * { 
            box-sizing:border-box;
            margin:0;
            padding:0;
        }
        @page {
            size: A4;
            margin: 0.5in;
        }
    }
    .badge { display:inline-flex; align-items:center; gap:5px; padding:6px 14px; border-radius:20px; font-size:.82rem; font-weight:700; }
    .badge-done { background:#e8f5e9; color:#2e7d32; }
    
    /* Form styling for screen and print */
    .form-document {
        background:white;
        border:1px solid #ddd;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
</style>

@endsection
