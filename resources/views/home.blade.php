@extends('layouts.app')

@section('title', 'VELORA HOMES — Curated Homes in Gujarat')
@section('meta_description', 'Discover luxury homes, villas, and penthouses across Ahmedabad, Surat, Vadodara, and Rajkot. Gujarat\'s most trusted real estate advisory.')

@push('styles')
    <link rel="stylesheet" href="/css/home.css">
@endpush

@section('content')

{{-- ══ HERO ══ --}}
<section class="hero" id="hero">
    <div class="hero-bg day"   id="bg-day"></div>
    <div class="hero-bg night" id="bg-night"></div>
    <div class="hero-overlay"></div>

    <button class="hero-toggle" id="day-night-toggle" aria-label="Toggle day or night view">
        <span class="toggle-label" id="toggle-label">Day View</span>
        <div class="toggle-switch"></div>
    </button>

    <div class="container">
        <div class="hero-content reveal">
            <div class="hero-eyebrow">
                <span class="hero-eyebrow-dot"></span>
                Gujarat &nbsp;·&nbsp; Ahmedabad &nbsp;·&nbsp; Surat &nbsp;·&nbsp; Rajkot
            </div>
            <h1 class="hero-title">Curated Living<br>in Gujarat</h1>
            <p class="hero-subtitle">Connecting discerning buyers with exceptional estates across Ahmedabad, Surat, and Rajkot.</p>
            <div class="hero-actions">
                <a href="{{ route('apartments.index') }}" class="btn-primary" style="padding:14px 32px; font-size:14px; border-radius:100px;">Browse Available Homes →</a>
                <a href="#sell-section" class="btn-outline" style="border-color:rgba(255,255,255,0.5); color:#ffffff; padding:13px 32px; font-size:14px; border-radius:100px;">Sell Your Property</a>
            </div>
        </div>
    </div>
</section>

{{-- ══ STATS BAR ══ --}}
<div class="stats-bar">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item reveal">
                <div class="stat-number" data-count="{{ $totalResidences ?? 25 }}">0</div>
                <div class="stat-label">Luxury Homes Listed</div>
            </div>
            <div class="stat-item reveal">
                <div class="stat-number" data-count="{{ $availableResidences ?? 14 }}">0</div>
                <div class="stat-label">Available Now</div>
            </div>
            <div class="stat-item reveal">
                <div class="stat-number" data-count="450" data-suffix=" Cr ₹">0</div>
                <div class="stat-label">Total Value Transacted</div>
            </div>
            <div class="stat-item reveal">
                <div class="stat-number" data-count="15" data-suffix=" Days">0</div>
                <div class="stat-label">Average Days to Sell</div>
            </div>
        </div>
    </div>
</div>

{{-- ══ FEATURED HOMES ══ --}}
<section class="listings-section">
    <div class="container">
        <div class="section-header-flex reveal">
            <div>
                <span class="label-small">Our Collection</span>
                <h2 class="section-title">Featured Homes<br>for Sale in Gujarat</h2>
            </div>
            <a href="{{ route('apartments.index') }}" class="btn-outline">
                View All Homes ({{ $totalResidences }})
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="margin-left:4px;"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        <div class="listings-grid">
            @forelse($featuredApartments as $apt)
            <article class="property-card reveal">
                <div class="property-img-wrapper">
                    <img src="{{ $apt->typology_image }}"
                         alt="{{ $apt->typology_label }} — Unit {{ $apt->unit_number }}"
                         loading="lazy" width="600" height="375">
                    <span class="property-status-tag {{ $apt->status === 'available' ? 'available' : '' }}"
                          aria-label="Status: {{ ucfirst($apt->status) }}">
                        {{ ucfirst($apt->status) }}
                    </span>
                    <button class="property-fav-btn" onclick="toggleFav(this)"
                            aria-label="Save to favourites" aria-pressed="false">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                        </svg>
                    </button>
                </div>
                <div class="property-body">
                    <span class="property-typology">{{ $apt->typology_label }}</span>
                    <h3 class="property-title">Home Unit {{ $apt->unit_number }} (Block {{ $apt->block }})</h3>
                    <p class="property-location">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        SG Highway, Ahmedabad
                    </p>
                    <div class="property-specs" aria-label="Property specifications">
                        <span class="spec-item">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            {{ $apt->bedrooms }} Beds
                        </span>
                        <span class="spec-item">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12h16"/><path d="M4 6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6H4V6z"/><path d="M6 18v2m12-2v2"/></svg>
                            {{ $apt->bedrooms }} Baths
                        </span>
                        <span class="spec-item">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="3" y1="9" x2="21" y2="9"/></svg>
                            {{ number_format($apt->area_sqft) }} sq.ft.
                        </span>
                    </div>
                    <div class="property-footer">
                        <span class="property-price">{{ $apt->formatted_price }}</span>
                        <a href="{{ route('apartments.show', $apt->id) }}" class="property-link">
                            View Details
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    </div>
                </div>
            </article>
            @empty
                <p style="color:var(--text-muted); font-family:'Inter',sans-serif; grid-column:1/-1; padding:40px 0;">No homes currently listed.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ══ SELL YOUR HOME + VALUATION ══ --}}
<section class="sell-section" id="sell-section">
    <div class="container">
        <div class="sell-grid">

            <div class="sell-content reveal">
                <span class="label-small" style="color:rgba(196,113,74,0.8);">Sell Your Property</span>
                <h2 class="section-title" style="color:#ffffff; margin-bottom:16px;">Want to sell your home?<br>Get top price easily.</h2>
                <p class="sell-lead">We help homeowners across Ahmedabad, Surat, Vadodara, and Rajkot sell quickly at the highest market value, connecting your property with genuine buyers across India.</p>

                <div class="sell-features">
                    <div class="sell-feature-box">
                        <div class="sell-feature-title">Verified Buyers Network</div>
                        <div class="sell-feature-desc">Active buyers seeking 2, 3, 4 BHK homes and luxury penthouses.</div>
                    </div>
                    <div class="sell-feature-box">
                        <div class="sell-feature-title">Free Instant Estimate</div>
                        <div class="sell-feature-desc">Live valuation based on recent Gujarat registry prices.</div>
                    </div>
                    <div class="sell-feature-box">
                        <div class="sell-feature-title">HD Photos & Virtual Tours</div>
                        <div class="sell-feature-desc">Professional photography to showcase your home beautifully.</div>
                    </div>
                    <div class="sell-feature-box">
                        <div class="sell-feature-title">Full Legal Support</div>
                        <div class="sell-feature-desc">Title clearance, D document, and paperwork — end to end.</div>
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="btn-primary" style="border-radius:100px; padding:14px 32px;">Request Free Home Appraisal →</a>
            </div>

            <div class="valuation-card reveal">
                <h3 class="valuation-title">Instant Home Price Estimator</h3>
                <p class="valuation-subtitle">Calculate your property's estimated market value in Gujarat right now.</p>

                <div class="val-form-group">
                    <label class="val-label" for="val-location">City / Micro-Market</label>
                    <select id="val-location" class="val-select" onchange="updateValuation()" aria-label="Select city">
                        <option value="7500">Ahmedabad — Sindhu Bhavan &amp; SG Highway</option>
                        <option value="6800">Surat — Vesu &amp; Piplod</option>
                        <option value="5500">Vadodara — Alkapuri &amp; Gotri</option>
                        <option value="4800">Rajkot — Kalavad Road &amp; 150 Ft Ring Rd</option>
                    </select>
                </div>

                <div class="val-form-group">
                    <label class="val-label" for="val-sqft">Super Built-up Area (sq. ft.)</label>
                    <input id="val-sqft" type="number" class="val-input" value="1800"
                           min="500" max="10000" step="50" oninput="updateValuation()"
                           aria-label="Enter area in square feet">
                </div>

                <div class="val-form-group">
                    <label class="val-label" for="val-type">Property Configuration</label>
                    <select id="val-type" class="val-select" onchange="updateValuation()" aria-label="Select configuration">
                        <option value="1.0">2 BHK / 3 BHK Premium Apartment</option>
                        <option value="1.15">4 BHK Garden Villa / Bungalow</option>
                        <option value="1.25">5 BHK Sky Penthouse with Rooftop</option>
                    </select>
                </div>

                <div class="valuation-result-box">
                    <div class="val-result-label">Estimated Market Value</div>
                    <div class="val-result-price" id="val-output">₹ 1.35 Crore</div>
                </div>

                <a href="{{ route('contact') }}" class="btn-primary" style="width:100%; text-align:center; border-radius:100px; display:block; padding:14px;">
                    Get Official Valuation Report →
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ══ EMI CALCULATOR ══ --}}
<section class="calc-section">
    <div class="container">
        <div class="section-header-flex reveal" style="margin-bottom:40px;">
            <div>
                <span class="label-small">Financing Tool</span>
                <h2 class="section-title">Home Loan EMI Calculator</h2>
            </div>
        </div>

        <div class="calc-grid">
            <div class="calc-card reveal">
                <div class="calc-slider-group">
                    <div class="calc-label-row">
                        <span class="calc-label-name">Home Price</span>
                        <span class="calc-label-val" id="display-price">₹ 1.20 Crore</span>
                    </div>
                    <input type="range" min="3000000" max="50000000" step="500000" value="12000000"
                           class="range-slider" id="slider-price" oninput="calculateMortgage()"
                           aria-label="Home price">
                </div>

                <div class="calc-slider-group">
                    <div class="calc-label-row">
                        <span class="calc-label-name">Down Payment</span>
                        <span class="calc-label-val" id="display-down">20% (₹ 24 Lakh)</span>
                    </div>
                    <input type="range" min="10" max="50" step="5" value="20"
                           class="range-slider" id="slider-down" oninput="calculateMortgage()"
                           aria-label="Down payment percentage">
                </div>

                <div class="calc-slider-group">
                    <div class="calc-label-row">
                        <span class="calc-label-name">Loan Tenure</span>
                        <span class="calc-label-val" id="display-years">20 Years</span>
                    </div>
                    <input type="range" min="5" max="30" step="5" value="20"
                           class="range-slider" id="slider-years" oninput="calculateMortgage()"
                           aria-label="Loan tenure in years">
                </div>

                <div class="calc-slider-group">
                    <div class="calc-label-row">
                        <span class="calc-label-name">Interest Rate (% p.a.)</span>
                        <span class="calc-label-val" id="display-rate">8.5%</span>
                    </div>
                    <input type="range" min="7.0" max="12.0" step="0.1" value="8.5"
                           class="range-slider" id="slider-rate" oninput="calculateMortgage()"
                           aria-label="Annual interest rate">
                </div>
            </div>

            <div class="calc-result-display reveal">
                <div class="calc-result-eyebrow">Estimated Monthly EMI</div>
                <div class="calc-result-number" id="calc-monthly-output">₹ 83,311</div>

                <div class="calc-breakdown">
                    <div class="calc-breakdown-row">
                        <span class="label">Loan Amount</span>
                        <span class="value" id="bd-principal">—</span>
                    </div>
                    <div class="calc-breakdown-row">
                        <span class="label">Total Interest</span>
                        <span class="value" id="bd-interest">—</span>
                    </div>
                    <div class="calc-breakdown-row">
                        <span class="label">Total Payment</span>
                        <span class="value" id="bd-total">—</span>
                    </div>
                </div>

                <p class="calc-result-note">We partner with SBI, HDFC, ICICI, and Axis Bank for fast loan approvals.</p>
                <a href="{{ route('contact') }}" class="btn-primary" style="width:100%; text-align:center; border-radius:100px; display:block; padding:14px;">
                    Talk with a Loan Advisor →
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ══ REVIEW ══ --}}
<section class="reviews-section">
    <div class="container">
        <div class="review-card reveal">
            <div class="review-stars" aria-label="5 out of 5 stars" style="font-size:18px; color:var(--terracotta); margin-bottom:8px; letter-spacing:2px;">★★★★★</div>
            <blockquote class="review-quote">
                "VELORA HOMES made buying our 3 BHK flat on Sindhu Bhavan Road seamless and fully transparent. Exceptional service with zero hidden charges."
            </blockquote>
            <div class="review-author-row">
                <div class="review-avatar" aria-hidden="true">RP</div>
                <div>
                    <div class="review-author">Rajesh &amp; Patel Family</div>
                    <div class="review-role">Home Buyers · Ahmedabad, Gujarat</div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// ── Day/Night toggle ──
const dayBg  = document.getElementById('bg-day');
const nightBg= document.getElementById('bg-night');
const toggle = document.getElementById('day-night-toggle');
const label  = document.getElementById('toggle-label');
let isNight  = false;

toggle.addEventListener('click', () => {
    isNight = !isNight;
    toggle.classList.toggle('night-mode', isNight);
    label.textContent = isNight ? 'Night View' : 'Day View';
    dayBg.classList.toggle('active', isNight);
    nightBg.classList.toggle('active', isNight);
});

// ── Counter animation ──
const counters = document.querySelectorAll('[data-count]');
if (counters.length) {
    const counterObs = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el     = entry.target;
            const target = parseInt(el.dataset.count);
            const suffix = el.dataset.suffix || '';
            const start  = performance.now();
            const dur    = 1400;
            const animate = (now) => {
                const prog  = Math.min((now - start) / dur, 1);
                const eased = 1 - Math.pow(1 - prog, 3);
                el.textContent = Math.floor(eased * target) + suffix;
                if (prog < 1) requestAnimationFrame(animate);
            };
            requestAnimationFrame(animate);
            counterObs.unobserve(el);
        });
    }, { threshold: 0.5 });
    counters.forEach(c => counterObs.observe(c));
}

// ── Indian currency formatter ──
function formatINR(num) {
    if (num >= 10000000) return '₹ ' + (num / 10000000).toFixed(2) + ' Crore';
    if (num >= 100000)   return '₹ ' + (num / 100000).toFixed(2) + ' Lakh';
    return '₹ ' + Math.round(num).toLocaleString('en-IN');
}

// ── Valuation calculator ──
function updateValuation() {
    const rate = parseFloat(document.getElementById('val-location').value) || 7500;
    const sqft = parseFloat(document.getElementById('val-sqft').value)     || 1800;
    const mul  = parseFloat(document.getElementById('val-type').value)     || 1.0;
    document.getElementById('val-output').textContent = formatINR(rate * sqft * mul);
}
updateValuation();

// ── EMI calculator ──
function calculateMortgage() {
    const price   = parseFloat(document.getElementById('slider-price').value);
    const downPct = parseFloat(document.getElementById('slider-down').value);
    const years   = parseInt(document.getElementById('slider-years').value);
    const ratePct = parseFloat(document.getElementById('slider-rate').value);

    const downAmt  = price * (downPct / 100);
    const principal= price - downAmt;
    const mRate    = (ratePct / 100) / 12;
    const n        = years * 12;

    document.getElementById('display-price').textContent = formatINR(price);
    document.getElementById('display-down').textContent  = downPct + '% (' + formatINR(downAmt) + ')';
    document.getElementById('display-years').textContent = years + ' Years';
    document.getElementById('display-rate').textContent  = ratePct.toFixed(1) + '%';

    let monthly = mRate > 0
        ? (principal * mRate * Math.pow(1 + mRate, n)) / (Math.pow(1 + mRate, n) - 1)
        : principal / n;

    const totalPayment  = monthly * n;
    const totalInterest = totalPayment - principal;

    document.getElementById('calc-monthly-output').textContent = '₹ ' + Math.round(monthly).toLocaleString('en-IN');
    document.getElementById('bd-principal').textContent        = formatINR(principal);
    document.getElementById('bd-interest').textContent         = formatINR(totalInterest);
    document.getElementById('bd-total').textContent            = formatINR(totalPayment);
}
calculateMortgage();

// ── Favourite toggle ──
function toggleFav(btn) {
    const saved = btn.classList.toggle('saved');
    btn.setAttribute('aria-pressed', saved);
    const path = btn.querySelector('path');
    if (path) path.setAttribute('fill', saved ? 'currentColor' : 'none');
}
</script>
@endpush
