<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'VELORA HOMES — Buy & sell luxury homes, apartments, villas, and penthouses in Gujarat, India (Ahmedabad, Surat, Vadodara, Rajkot).')">
    <title>@yield('title', 'VELORA HOMES — Buy & Sell Homes in Gujarat, India')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    @stack('styles')
</head>
<body>

<nav id="main-nav" class="@yield('nav_class')">
    <a href="{{ route('home') }}" class="nav-logo">VELORA HOMES</a>
    <button class="hamburger" id="hamburger-btn" aria-label="Open navigation menu">
        <span></span><span></span><span></span>
    </button>
    <ul class="nav-links" id="nav-links">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('apartments.index') }}">Browse Homes</a></li>
        <li><a href="{{ route('home') }}#sell-section">Sell Your Home</a></li>
        <li><a href="{{ route('contact') }}">Contact Us</a></li>
        @guest
            <li><a href="{{ route('login') }}">Sign In</a></li>
            <li><a href="{{ route('register') }}" class="nav-cta">Register</a></li>
        @endguest
        @auth
            <li>
                <a href="{{ route('profile.show') }}" class="nav-avatar-btn" aria-label="View {{ Auth::user()->name }}'s profile">
                    @if(Auth::user()->avatar_url)
                        <img src="{{ Auth::user()->avatar_url }}" alt="" class="nav-avatar-img">
                    @else
                        <span class="nav-avatar-initials" aria-hidden="true">{{ Auth::user()->initials }}</span>
                    @endif
                    <span class="user-greeting">My Profile</span>
                </a>
            </li>
            @if(Auth::user()->is_admin)
                <li><a href="{{ route('admin.dashboard') }}" class="nav-cta" style="background:var(--dark);color:#fff !important;">⚙ Admin</a></li>
            @endif
            <li>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn-link">Log Out</button>
                </form>
            </li>
            <li><a href="{{ route('contact') }}" class="nav-cta">Contact Us</a></li>
        @endauth
    </ul>
</nav>

<main>
    @if(session('success'))
        <div class="flash-toast" id="flash-toast">
            <span>{{ session('success') }}</span>
            <button class="flash-toast-close" onclick="document.getElementById('flash-toast').remove()">&times;</button>
        </div>
    @endif
    @if(session('error'))
        <div class="flash-toast error" id="flash-toast">
            <span>{{ session('error') }}</span>
            <button class="flash-toast-close" onclick="document.getElementById('flash-toast').remove()">&times;</button>
        </div>
    @endif

    @yield('content')
</main>

<footer>
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="footer-brand">VELORA HOMES</div>
                <p class="footer-tagline">Gujarat's trusted real estate partner. Easy home buying, fast property selling, and transparent guidance across Ahmedabad, Surat, Vadodara, and Rajkot.</p>
            </div>
            <div>
                <div class="footer-heading">Quick Links</div>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('apartments.index') }}">Browse All Homes</a></li>
                    <li><a href="{{ route('home') }}#sell-section">Sell Your Home</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
            <div>
                <div class="footer-heading">Contact Info <span class="footer-heading-location">Gujarat</span></div>
                <ul class="footer-contact-list">
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.96.36 1.9.7 2.8a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.84.58 2.8.7A2 2 0 0 1 22 16.92z"/></svg>
                        </span>
                        <span class="footer-contact-copy">
                            <span class="footer-contact-label">Call us</span>
                            <a href="tel:+919876543210">+91 98765 43210</a>
                        </span>
                    </li>
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                        </span>
                        <span class="footer-contact-copy">
                            <span class="footer-contact-label">Email</span>
                            <a href="mailto:info@velorahomes.in">info@velorahomes.in</a>
                        </span>
                    </li>
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                        </span>
                        <span class="footer-contact-copy">
                            <span class="footer-contact-label">Visit us</span>
                            <a href="https://maps.google.com/?q=SG+Highway,+Bodakdev,+Ahmedabad,+Gujarat+380054"
                               target="_blank" rel="noopener noreferrer">
                                SG Highway, Bodakdev, Ahmedabad, Gujarat 380054
                            </a>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} VELORA HOMES India. All rights reserved.</p>
            <p><a href="#" style="color:rgba(255,255,255,0.5);margin-right:16px;">Privacy Policy</a><a href="#" style="color:rgba(255,255,255,0.5);">Terms of Use</a></p>
        </div>
    </div>
</footer>

<div id="cookie-banner">
    <p class="cookie-text">We use cookies to ensure you get the best experience on our website.</p>
    <button class="cookie-btn" id="cookie-accept">Accept &amp; Continue</button>
</div>

<script>
    // Nav scroll effect
    const nav = document.getElementById('main-nav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 50);
    }, { passive: true });

    // Mobile menu toggle
    document.getElementById('hamburger-btn').addEventListener('click', () => {
        document.getElementById('nav-links').classList.toggle('open');
    });

    // Scroll reveal animation
    const revealEls = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); } });
    }, { threshold: 0.1 });
    revealEls.forEach(el => observer.observe(el));

    // Cookie banner
    const banner = document.getElementById('cookie-banner');
    if (!localStorage.getItem('cookies_accepted')) {
        setTimeout(() => banner.classList.add('visible'), 1000);
    }
    document.getElementById('cookie-accept').addEventListener('click', () => {
        localStorage.setItem('cookies_accepted', '1');
        banner.classList.remove('visible');
    });
</script>
@stack('scripts')
</body>
</html>
