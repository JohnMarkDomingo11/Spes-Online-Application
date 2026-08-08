<!DOCTYPE html>
<html>
<head>
<title>SPES Form 2 - Application Form</title>
<style>
* {box-sizing: border-box; margin: 0; padding: 0;}
body {font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px;}
.form-container {
    width: 850px;
    margin: auto;
    background: #fff;
    padding: 40px;
    position: relative;
    overflow: hidden;
    z-index: 1;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
             .form-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            
            /* YOUR IMAGE URL */
            background-image: url('spes_logo.png'); 
            background-repeat: no-repeat;
            background-position: center; /* CENTERED */
            background-size: 500px; /* NOT TOO BIG */
            
            /* EFFECTS: Black & White + Blur + Faint */
            filter: grayscale(100%) blur(5px);
            opacity: 0.12; /* VERY LIGHT so text is clear */
            
            z-index: -1;
        /* Top Right Meta */
            }
.header {display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;}
.logo-group {display: flex; gap: 15px; align-items: center;}
.logo {height: 65px;}
.header-text {text-align: center; flex-grow: 1; line-height: 1.4;}
.form-id {text-align: right; font-size: 12px; margin-bottom: 10px;}
.photo-box {
    width: 120px;
    height: 160px;
    border: 1px solid #333;
    text-align: center;
    padding: 10px;
    font-size: 12px;
}

/* CONTENT */
h1 {text-align: center; font-size: 22px; margin: 20px 0;}
h3 {text-align: center; margin: 10px 0; line-height: 1.5;}
p, li {font-size: 14px; line-height: 1.6; text-align: justify; margin: 8px 0;}
.small-text {font-size: 12px;}

/* FORM FIELDS */
input, textarea {
    border: none;
    border-bottom: 1px solid #333;
    padding: 2px 5px;
    font-size: 14px;
    background: transparent;
}
.control-row {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    width: auto;
}
.control-no-line {
    flex: 0 0 120px;
    width: 120px;
    min-width: 120px;
    height: 1px;
    border-bottom: 1px solid #333;
    margin-left: 0;
}
textarea { border: 1px solid #333; padding: 8px; resize: vertical; background: #fff; }
.wide {width: 300px;}
.medium {width: 150px;}
.small {width: 80px;}
.xsmall {width: 50px;}
.tiny {width: 30px;}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 15px 0;
}
table td, table th {
    border: 1px solid #333;
    padding: 8px;
    font-size: 14px;
}
.checkbox {margin-right: 5px;}

/* SECTIONS */
.section {margin: 20px 0;}
.row {display: flex; align-items: center; margin: 8px 0; gap: 10px; flex-wrap: wrap;}
.label {min-width: 180px;}
.error {color: #b71c1c; font-size: 13px; margin-top: 8px;}
.alert {background: #ffebee; border: 1px solid #f44336; color: #b71c1c; padding: 12px 14px; border-radius: 8px; margin-bottom: 20px;}
.submit-row {display:flex; justify-content:flex-end; margin-top:20px;}
.submit-button {background:#004d40; border:none; color:#fff; padding:12px 22px; border-radius:6px; cursor:pointer; font-size:14px;}
.submit-button:hover {opacity:.92;}
    .top-actions {display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; gap:12px; flex-wrap:wrap;}
    .top-actions a, .top-actions button {background:#004d40; color:#fff; border:none; padding:10px 18px; border-radius:6px; text-decoration:none; font-size:13px; cursor:pointer;}
    .top-actions a {display:inline-flex; align-items:center; justify-content:center;}
    .top-actions a:hover, .top-actions button:hover {opacity:.92;}
</style>
</head>
<body>

<div class="form-container">
    <form method="POST" action="{{ route('applications.form2.store') }}">
        @csrf

        <div class="top-actions">
            <a href="{{ route('applications.myApplication') }}">&laquo; Back to My Application</a>
            <button type="submit">Submit Form 2</button>
        </div>

        <div class="header">
            <div class="logo-group">
                <img src="bagong-pilipinas-logo.png" alt="Logo" class="logo">
                <img src="dole-logo.png" alt="Logo" class="logo">
            </div>
            <div class="header-text">
                <strong>REPUBLIC OF THE PHILIPPINES<br>
                DEPARTMENT OF LABOR AND EMPLOYMENT<br>
                REGIONAL OFFICE NO.<br>
                Public Employment Service Office</strong>
            </div>
            <div class="photo-box">
                Passport Size Photo<br>(3.5cm x 4.5cm)
            </div>
        </div>

        <div class="form-id">SPES Form 2</div>

        <h3>SPECIAL PROGRAM FOR EMPLOYMENT OF STUDENTS<br>
        <small>(RA 7323, as amended by RAs 9547 and 10917)</small></h3>

        <h1>APPLICATION FORM</h1>

        @if($errors->any())
            <div class="alert">
                <strong>Please fix the following errors:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row" style="align-items:center;">
            <div class="control-row">
                <span class="label">Control No.:</span>
                <span class="control-no-line" aria-hidden="true"></span>
            </div>
        </div>

        <!-- CONSENT SECTION -->
        <div class="section">
            <h4>Consent and Data Privacy Notice:</h4>
            <p class="small-text">The Department of Labor and Employment (DOLE) collects and processes your personal data to determine eligibility for the Special Program for Employment of Students (SPES), facilitate job placement, and process stipends. Your information may be shared with partner-employers and relevant government agencies for verification and payroll purposes, in compliance with Republic Act No. 10173 (Data Privacy Act of 2012).</p>
            <p class="small-text">Furthermore, I hereby grant my absolute consent to DOLE to use my name, profile, photos, and/or videos taken during the program in its official advocacy materials, social media pages, and other communication channels for the purpose of promoting the program.</p>
            <p>You maintain the right to access or correct your data at any time.
            <label><input type="checkbox" class="checkbox" name="f2_consent_accepted" value="1" {{ old('f2_consent_accepted', $application->f2_consent_accepted) ? 'checked' : '' }}> I ACCEPT</label>
            <label><input type="checkbox" class="checkbox" disabled> I DO NOT ACCEPT</label></p>
            @error('f2_consent_accepted')<div class="error">{{ $message }}</div>@enderror
        </div>

        <!-- CHECKLIST -->
        <div class="section">
            <h4>Checklist of Documentary Requirements:</h4>
            <p class="small-text">(Original and other documents, when applicable, should be presented for validation.)</p>
            @php
                $checklist = old('f2_checklist', json_decode($application->f2_checklist ?? '[]', true) ?: []);
            @endphp
            <p><label><input type="checkbox" class="checkbox" name="f2_checklist[]" value="birth_cert" {{ in_array('birth_cert', $checklist) ? 'checked' : '' }}> 1. Photocopy of Birth Certificate OR any document indicating date of birth or age (age must be 15-30 years old); and</label></p>
            <p><label><input type="checkbox" class="checkbox" name="f2_checklist[]" value="itr_or_exemption" {{ in_array('itr_or_exemption', $checklist) ? 'checked' : '' }}> 2. Photocopy of the latest Income Tax Return (ITR) of parents/legal guardian OR certification issued by BIR that the Parents/guardians are exempted from payment of tax OR Original Certificate of Indigence OR Original Certificate of Low Income issued by the Barangay or DSWD/CSWD where the applicant resides; and</label></p>
            <p><strong>FOR STUDENTS any of the following, in addition to requirements no. 1 and 2:</strong></p>
            <p><label><input type="checkbox" class="checkbox" name="f2_checklist[]" value="proof_of_grades" {{ in_array('proof_of_grades', $checklist) ? 'checked' : '' }}> a. Photocopy of proof of average passing grade such as (1) class card or (2) Form 138 of the previous semester or year immediately preceding the application, OR</label></p>
            <p><label><input type="checkbox" class="checkbox" name="f2_checklist[]" value="cert_grade" {{ in_array('cert_grade', $checklist) ? 'checked' : '' }}> b. Original copy of Certification by the School Registrar as to passing grade immediately preceding semester/year if grades are not yet available.</label></p>
            <p><strong>FOR OUT-OF-SCHOOL YOUTHS, in addition to requirements no. 1 and 2:</strong></p>
            <p><label><input type="checkbox" class="checkbox" name="f2_checklist[]" value="osy_cert" {{ in_array('osy_cert', $checklist) ? 'checked' : '' }}> Original copy of Certification as OSY issued by DSWD/CSWD or the authorized Barangay Official where the OSY resides.</label></p>
        </div>

        <!-- APPLICANT INFO -->
        <div class="section">
            <h4>Student / Applicant's Information:</h4>
            <div class="row">
                <span class="label">NAME:</span>
                <input type="text" class="medium" name="f2_last_name" placeholder="(Last Name)" value="{{ old('f2_last_name') }}">
                <input type="text" class="medium" name="f2_first_name" placeholder="(First Name)" value="{{ old('f2_first_name') }}">
                <input type="text" class="small" name="f2_middle_name" placeholder="(Middle Name)" value="{{ old('f2_middle_name') }}">
            </div>
            <div class="row">
                <span class="label">DATE OF BIRTH:</span>
                <input type="text" class="small" name="f2_date_of_birth" placeholder="(MM/DD/YYYY)" value="{{ old('f2_date_of_birth') }}">
                <span class="label">PLACE OF BIRTH:</span>
                <input type="text" class="medium" name="f2_place_of_birth" value="{{ old('f2_place_of_birth', $application->f2_place_of_birth) }}">
                <span class="label">SEX:</span>
                <input type="text" class="small" name="f2_sex" placeholder="(Male/Female)" value="{{ old('f2_sex') }}">
            </div>
            <div class="row">
                <span class="label">STATUS:</span>
                <input type="text" class="medium" name="f2_status" value="{{ old('f2_status') }}">
                <span class="label">CITIZENSHIP:</span>
                <input type="text" class="medium" name="f2_citizenship" value="{{ old('f2_citizenship', $application->f2_citizenship ?? 'Filipino') }}">
            </div>
            <div class="row">
                <span class="label">EMAIL ADDRESS:</span>
                <input type="text" class="wide" name="f2_email" value="{{ old('f2_email', $application->f2_email) }}">
                <span class="label">SOCIAL MEDIA ACCOUNT:</span>
                <input type="text" class="medium" name="f2_social_media" placeholder="(Facebook/Instagram/X etc.)" value="{{ old('f2_social_media', $application->f2_social_media) }}">
            </div>
            <div class="row">
                <span class="label">GSIS BENEFICIARY/RELATIONSHIP:</span>
                <input type="text" class="medium" name="f2_gsis_beneficiary" value="{{ old('f2_gsis_beneficiary', $application->f2_gsis_beneficiary) }}">
                <span class="label">CONTACT NUMBER:</span>
                <input type="text" class="medium" name="f2_contact_number" value="{{ old('f2_contact_number') }}">
            </div>
            <div class="row">
                <span class="label">PRESENT ADDRESS:</span>
                <input type="text" class="wide" name="f2_present_address" value="{{ old('f2_present_address', $application->f2_present_address) }}">
            </div>
            <div class="row">
                <span class="label">PERMANENT ADDRESS:</span>
                <input type="text" class="wide" name="f2_permanent_address" value="{{ old('f2_permanent_address', $application->f2_permanent_address) }}">
            </div>
            <div class="row">
                <span class="label">APPLICANT'S CATEGORY:</span>
                <input type="text" class="wide" name="f2_applicant_category" placeholder="(STUDENT/ALS STUDENT/OUT OF SCHOOL YOUTH)" value="{{ old('f2_applicant_category', $application->f2_applicant_category) }}">
            </div>
        </div>

        <!-- EDUCATION TABLE -->
        @php
            $eduHistory = json_decode($application->f2_education_history ?? '[]', true) ?: [];
        @endphp
        <table>
            <tr>
                <th>EDUCATION</th>
                <th>NAME OF SCHOOL</th>
                <th>COURSE</th>
                <th>YEAR LEVEL</th>
                <th>DATE OF ATTENDANCE</th>
            </tr>
            @foreach(['Elementary','Secondary','Tertiary','Tech-Voc'] as $index => $level)
            @php $row = $eduHistory[$index] ?? []; @endphp
            <tr>
                <td>{{ $level }}</td>
                <td><input type="text" name="education[{{ $index }}][school]" style="width:100%" value="{{ old("education.$index.school", $row['school'] ?? '') }}"></td>
                <td><input type="text" name="education[{{ $index }}][course]" style="width:100%" value="{{ old("education.$index.course", $row['course'] ?? '') }}"></td>
                <td><input type="text" name="education[{{ $index }}][year_level]" style="width:100%" value="{{ old("education.$index.year_level", $row['year_level'] ?? '') }}"></td>
                <td><input type="text" name="education[{{ $index }}][date]" style="width:100%" value="{{ old("education.$index.date", $row['date'] ?? '') }}"></td>
            </tr>
            @endforeach
        </table>

        <!-- PARENTS INFO -->
        @php
            $selectedParentStatus = old('parent_status_details', $application->f2_parent_status_details ? explode(',', $application->f2_parent_status_details) : []);
        @endphp
        <div class="section">
            <div class="row">
                <span class="label">FATHER'S NAME and CONTACT NO.:</span>
                <input type="text" class="wide" name="f2_father_info" value="{{ old('f2_father_info') }}">
            </div>
            <div class="row">
                <span class="label">OCCUPATION:</span>
                <input type="text" class="medium" name="f2_father_occupation" value="{{ old('f2_father_occupation', $application->f2_father_occupation) }}">
            </div>
            <div class="row">
                <span class="label">MOTHER'S NAME and CONTACT NO.:</span>
                <input type="text" class="wide" name="f2_mother_info" value="{{ old('f2_mother_info') }}">
            </div>
            <div class="row">
                <span class="label">OCCUPATION:</span>
                <input type="text" class="medium" name="f2_mother_occupation" value="{{ old('f2_mother_occupation', $application->f2_mother_occupation) }}">
            </div>
            <p><strong>CURRENT STATUS OF PARENTS:</strong>
            <label><input type="checkbox" class="checkbox" name="parent_status_details[]" value="Living Together" {{ in_array('Living Together', $selectedParentStatus) ? 'checked' : '' }}> Living Together</label>
            <label><input type="checkbox" class="checkbox" name="parent_status_details[]" value="Solo Parent" {{ in_array('Solo Parent', $selectedParentStatus) ? 'checked' : '' }}> Solo Parent</label>
            <label><input type="checkbox" class="checkbox" name="parent_status_details[]" value="Separated" {{ in_array('Separated', $selectedParentStatus) ? 'checked' : '' }}> Separated</label>
            <label><input type="checkbox" class="checkbox" name="parent_status_details[]" value="Persons with Disability" {{ in_array('Persons with Disability', $selectedParentStatus) ? 'checked' : '' }}> Persons with Disability</label>
            <label><input type="checkbox" class="checkbox" name="parent_status_details[]" value="Senior Citizen" {{ in_array('Senior Citizen', $selectedParentStatus) ? 'checked' : '' }}> Senior Citizen</label><br>
            <label><input type="checkbox" class="checkbox" name="parent_status_details[]" value="Sugar Plantation Worker" {{ in_array('Sugar Plantation Worker', $selectedParentStatus) ? 'checked' : '' }}> Sugar Plantation Worker</label>
            <label><input type="checkbox" class="checkbox" name="parent_status_details[]" value="Indigenous People" {{ in_array('Indigenous People', $selectedParentStatus) ? 'checked' : '' }}> Indigenous People</label>
            <label><input type="checkbox" class="checkbox" name="parent_status_details[]" value="Displaced Worker" {{ in_array('Displaced Worker', $selectedParentStatus) ? 'checked' : '' }}> Displaced Worker</label>
            <label><input type="checkbox" class="checkbox" name="parent_status_details[]" value="4Ps Beneficiary" {{ in_array('4Ps Beneficiary', $selectedParentStatus) ? 'checked' : '' }}> 4Ps Beneficiary</label>
            <label><input type="checkbox" class="checkbox" name="parent_status_details[]" value="LOCAL (2)" {{ in_array('LOCAL (2)', $selectedParentStatus) ? 'checked' : '' }}> LOCAL (2)</label>
            <label><input type="checkbox" class="checkbox" name="parent_status_details[]" value="OFW" {{ in_array('OFW', $selectedParentStatus) ? 'checked' : '' }}> OFW</label></p>
            <div class="row">
                <span class="label">SPECIAL SKILLS:</span>
                <input type="text" class="wide" name="f2_special_skills" value="{{ old('f2_special_skills', $application->f2_special_skills) }}">
            </div>
        </div>

        <!-- HISTORY TABLE -->
        @php
            $spesHistory = json_decode($application->f2_spes_history ?? '[]', true) ?: [];
        @endphp
        <table>
            <tr>
                <th colspan="2">HISTORY OF SPES Availment & Name of Establishment</th>
                <th>Year</th>
                <th>SPES ID No. (If Applicable)</th>
            </tr>
            @foreach(['1st Availment','2nd Availment','3rd Availment','4th Availment'] as $index => $label)
            @php $row = $spesHistory[$index] ?? []; @endphp
            <tr>
                <td><label><input type="checkbox" class="checkbox" name="spes_history[{{ $index }}][selected]" value="1" {{ old("spes_history.$index.selected", $row['selected'] ?? null) ? 'checked' : '' }}> {{ $label }}</label></td>
                <td><input type="text" style="width:100%" name="spes_history[{{ $index }}][establishment]" value="{{ old("spes_history.$index.establishment", $row['establishment'] ?? '') }}"></td>
                <td><input type="text" style="width:100%" name="spes_history[{{ $index }}][year]" value="{{ old("spes_history.$index.year", $row['year'] ?? '') }}"></td>
                <td><input type="text" style="width:100%" name="spes_history[{{ $index }}][id]" value="{{ old("spes_history.$index.id", $row['id'] ?? '') }}"></td>
            </tr>
            @endforeach
        </table>

        <div class="row">
            <span class="label">Other related information/requests/interventions from DOLE:</span>
            <input type="text" class="wide" name="f2_other_info" value="{{ old('f2_other_info', $application->f2_other_info) }}">
        </div>

        <p style="margin-top: 30px; font-size: 13px;">I hereby attest that the information above is true and correct to the best of my knowledge, including the attached documents / requirements which I also attest as to their veracity. I agree that any false statement would cause the automatic disqualification/ cancellation of the service/ contract/ grant and I shall refund the amount received and/or pay damages to DOLE or comply with other sanctions in accordance with law. Any material change in my financial status may affect my eligibility to continue the program.</p>

        <div class="submit-row">
            <button type="submit" class="submit-button">Save Form 2</button>
        </div>
    </form>
</div>

</body>
</html>
