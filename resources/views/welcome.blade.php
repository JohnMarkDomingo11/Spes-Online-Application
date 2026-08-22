<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official SPES Portal | PESO Lallo</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- Your custom stylesheet (public/css/auth.css) --}}
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('images/lallo_logo.png') }}" alt="LGU Logo">
         SPES <span>Lal-lo</span>
        </div>
        
        {{-- Desktop Navigation --}}
        <div class="nav-links desktop-nav">
            <a href="#about">About</a>
            <a href="#qualifications">Eligibility</a>
            <a href="#process">Process</a>
        </div>

        {{-- Mobile Navigation (Hamburger Menu) --}}
        <button class="hamburger-menu" id="hamburger-btn">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="mobile-menu" id="mobile-menu">
            <a href="#about">About</a>
            <a href="#qualifications">Eligibility</a>
            <a href="#process">Process</a>
        </div>
          <div class="nav-auth">
             <a href="{{ url('/login') }}" class="btn-login">Login</a>
        {{-- Auth Buttons (Always visible) --}}
        <a href="{{ url('/register') }}" class="btn-nav">Sign Up</a>
          </div>
    </nav>

    {{-- ===== HERO SECTION ===== --}}
    <section class="hero" >
        <div class="hero-overlay"></div>
        <div class="hero-content fade-in-up">
            <span class="badge">Department of Labor and Employment</span>
            <h1>Special Program for Employment of Students (SPES)</h1>
            <p class="hero-desc">
                Bridging the gap between education and employment. A government initiative mandating
                the employment of poor but deserving students, out-of-school youth, and dependents
                of displaced workers.
            </p>
            <div class="cta-group">
                <a href="#about" class="btn-outline">Learn More</a>
                <a href="{{ url('/register') }}" class="btn-filled">Apply Now</a>
            </div>
        </div>
    </section>

    {{-- ===== ABOUT SECTION ===== --}}
    <section id="about" class="section light-bg">
        <div class="container">
            <div class="row">
                <div class="col-text slide-in-left">
                    <h4 class="sub-title">Program History &amp; Mandate</h4>
                    <h2>Empowering Youth Since 1992</h2>
                    <p>
                        The SPES is an employment-bridging program enacted under
                        <strong>Republic Act No. 7323</strong> on March 30, 1992. Its core mission is to
                        assist financially challenged students in pursuing their education by providing
                        short-term employment during summer and/or Christmas vacations.
                    </p>
                    <p>
                        Over the decades, the program has evolved to serve more beneficiaries through
                        <strong>Republic Act No. 9547</strong> (2009) and further strengthened by
                        <strong>Republic Act No. 10917</strong> (2016), which expanded the age limit to
                        30 years old and extended the employment duration.
                    </p>

                    <div class="info-box">
                        
                        <div>
                            <strong>The 60/40 Salary Scheme</strong>
                            <p>
                                Beneficiaries receive a salary no less than the minimum wage. 60% is paid
                                by the employer (LGU/Private), and the remaining 40% is subsidized by DOLE
                                in the form of education vouchers or cash.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-image slide-in-right">
                    <div class="image-stack">
                        <div class="img-top">
                            
                            <span>Education First</span>
                        </div>
                        <div class="img-bottom">
                    
                            <span>Gain Experience</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== QUALIFICATIONS SECTION ===== --}}
    <section id="qualifications" class="section dark-bg">
        <div class="container">
            <div class="section-header fade-in">
                <h2>Who is Eligible to Apply?</h2>
                <p>Ensure you meet the following criteria set by the DOLE guidelines before submitting your application.</p>
            </div>

            <div class="grid-3">
                <div class="card fade-in">
                    
                    <h3>Age Requirement</h3>
                    <p>Applicants must be at least <strong>15 years of age</strong> but not more than <strong>30 years old</strong> at the time of application.</p>
                </div>
                <div class="card fade-in">
                    
                    <h3>Educational Status</h3>
                    <p>Must be currently enrolled, or an Out-of-School Youth (OSY) who intends to enroll in the upcoming school year. Must have a passing general weighted average.</p>
                </div>
                <div class="card fade-in">
                   
                    <h3>Financial Status</h3>
                    <p>The combined net income after tax of the applicant's parents, including their own (if any), must not exceed the annual regional poverty threshold.</p>
                </div>
            </div>

            <div class="requirements-box fade-in-up">
                <h3><i class="fa-solid fa-folder-open"></i> Documentary Requirements</h3>
                <div class="req-grid">
                    <ul>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            <strong>Birth Certificate:</strong> Photocopy of PSA or LCR birth certificate.
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            <strong>School Record:</strong> Form 138 (Report Card) or Certification of Grades (GWA must be passing).
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            <strong>Proof of Income:</strong> Latest ITR of parents or Certificate of Indigence from the Barangay.
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            <strong>ID Photos:</strong> 2 pieces recent passport-size or 2x2 ID pictures.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== PROCESS / TIMELINE SECTION ===== --}}
    <section id="process" class="section light-bg">
        <div class="container">
            <div class="section-header fade-in">
                <h2>Application Procedure</h2>
                <p>Follow these steps to secure your slot in the SPES program.</p>
            </div>

            <div class="timeline">
                <div class="timeline-item slide-in-left">
                    <div class="step-number">01</div>
                    <div class="step-content">
                        <h4>Create an Account</h4>
                        <p>Register on this portal using your email address. Ensure all personal details match your documents.</p>
                    </div>
                </div>
                <div class="timeline-item slide-in-right">
                    <div class="step-number">02</div>
                    <div class="step-content">
                        <h4>Submit Application Form</h4>
                        <p>Fill out the SPES Form 2 digitally. Upload clear scanned copies of your requirements (Birth Cert, Grades, ITR/Indigence).</p>
                    </div>
                </div>
                <div class="timeline-item slide-in-left">
                    <div class="step-number">03</div>
                    <div class="step-content">
                        <h4>Wait for Evaluation</h4>
                        <p>The PESO Officer will review your submission. You can track your status (Pending/Approved) via the Notification Bar on your dashboard.</p>
                    </div>
                </div>
                <div class="timeline-item slide-in-right">
                    <div class="step-number">04</div>
                    <div class="step-content">
                        <h4>Orientation &amp; Deployment</h4>
                        <p>Once approved, you will be notified of the orientation schedule. Successful applicants will be assigned to their respective Local Government Units or partner agencies.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== CTA FINAL SECTION ===== --}}
    <section class="cta-final">
        <div class="cta-content fade-in-up">
            <h2>Start Your Journey Today</h2>
            <p>Be part of the nation-building workforce. Earn while you learn.</p>
            <a href="{{ url('/register') }}" class="btn-giant">
                Apply for SPES Now <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </section>

    {{-- ===== FOOTER ===== --}}
    <footer>
        <div class="footer-container">
            <div class="footer-info">
                <h4>PESO Lallo</h4>
                <p>Located on:P. DUPAYA STREET, CENTRO, LAL-LO, CAGAYAN, 3509
                    </p>
                <p>Email: lgulalloinformationoffice@gmail.com</p>
            </div>
            <div class="footer-socials">
               <div class="social-links">
                <a href="https://www.facebook.com/share/1EacDYqY7N/"><i class="bi-brands bi-facebook"></i> Follow us on Facebook</a>
                </div>
                <div class="social-links">
                <a href="https://www.instagram.com/official.lgulallo?igsh=MXU5dDJ1anR0dzEzaQ=="><i class="fa-brands fa-instagram"></i> Follow us on Instagram</a>
               </div>
            </div>
        </div>
        <div class="copyright">
            &copy; {{ date('Y') }} SPES Management System. In compliance with RA 10917.
        </div>
    </footer>

    {{-- Your custom JavaScript (public/js/auth.js) --}}
    <script src="{{ asset('js/auth.js') }}"></script>

</body>
</html>