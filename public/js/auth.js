// Auth Form Validation and Effects
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    if (form) {
        // Form submission handler
        form.addEventListener('submit', function(e) {
            // Disable submit button to prevent double submission
            const submitBtn = form.querySelector('.btn-submit');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.7';
            }
        });

        // Real-time form validation
        const inputs = form.querySelectorAll('input[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });

            input.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    validateField(this);
                }
            });
        });
    }
});

// Validate individual field
function validateField(field) {
    const value = field.value.trim();
    let isValid = false;

    if (field.type === 'email') {
        isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
    } else if (field.type === 'password') {
        isValid = value.length >= 6;
    } else if (field.name === 'password_confirmation') {
        const password = document.querySelector('input[name="password"]');
        isValid = value === password.value;
    } else if (field.name === 'name') {
        isValid = value.length >= 2;
    } else {
        isValid = value.length > 0;
    }

    if (isValid) {
        field.classList.remove('error');
    } else {
        field.classList.add('error');
    }

    return isValid;
}

// Show/hide password functionality
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    if (input) {
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
}
/**
 * SPES Portal — public/js/auth.js
 * Place this file at: public/js/auth.js
 * Loaded via: {{ asset('js/auth.js') }}  (at the bottom of welcome.blade.php)
 */

document.addEventListener('DOMContentLoaded', () => {

    /* ------------------------------------------------------------------
       1.  SCROLL-TRIGGERED ANIMATIONS
           Watches .fade-in-up, .fade-in, .slide-in-left, .slide-in-right
           and adds the .visible class when each element enters the viewport.
    ------------------------------------------------------------------ */
    const animatedElements = document.querySelectorAll(
        '.fade-in-up, .fade-in, .slide-in-left, .slide-in-right'
    );

    const observerOptions = {
        threshold: 0.15,              // trigger when 15 % of element is visible
        rootMargin: '0px 0px -50px 0px'  // slightly before the bottom edge
    };

    const appearOnScroll = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;

            entry.target.classList.add('visible');
            observer.unobserve(entry.target); // animate only once
        });
    }, observerOptions);

    animatedElements.forEach(el => appearOnScroll.observe(el));


    /* ------------------------------------------------------------------
       2.  NAVBAR SHADOW ON SCROLL
           Deepens the navbar box-shadow once the user scrolls past 50 px.
    ------------------------------------------------------------------ */
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', () => {
        navbar.style.boxShadow = window.scrollY > 50
            ? '0 5px 20px rgba(0, 0, 0, 0.1)'
            : '0 2px 10px rgba(0, 0, 0, 0.05)';
    });


    /* ------------------------------------------------------------------
       3.  HAMBURGER MENU TOGGLE
           Toggles the mobile menu on burger click and closes when a link is clicked.
    ------------------------------------------------------------------ */
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileLinks = mobileMenu.querySelectorAll('a');

    // Toggle menu on hamburger click
    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', () => {
            hamburgerBtn.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        });
    }

    // Close menu when a link is clicked
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            hamburgerBtn.classList.remove('active');
            mobileMenu.classList.remove('active');
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.navbar')) {
            hamburgerBtn.classList.remove('active');
            mobileMenu.classList.remove('active');
        }
    });

});
