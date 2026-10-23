@extends('layouts.app')

@section('title', 'Contact Us — VELORA HOMES Gujarat')
@section('meta_description', 'Contact VELORA HOMES for home buying, selling, or booking site visits in Ahmedabad, Surat, Vadodara, and Rajkot, Gujarat.')
@section('nav_class', 'nav-light')

@push('styles')
    <link rel="stylesheet" href="/css/contact.css">
@endpush

@section('content')

<div class="contact-page">
    <div class="container">

        {{-- Page Intro --}}
        <div class="contact-intro reveal">
            <span class="kicker">Gujarat Advisory</span>
            <h1>Connect with Our<br>Private Office</h1>
            <p>Have questions about buying, selling, or booking a site visit? Our local advisors will respond within 2 hours.</p>
        </div>

        <div class="contact-grid">

            {{-- ══ LEFT: Concierge Info ══ --}}
            <div class="contact-sidebar reveal">

                <div class="contact-office-visual">
                    <img src="/images/rooftop_view.jpg"
                         alt="A private residence overlooking the coast"
                         class="sidebar-img"
                         loading="lazy">
                    <div class="contact-office-caption">
                        <span>VELORA HOMES · GUJARAT</span>
                        <strong>Local insight.<br>Exceptional homes.</strong>
                    </div>
                </div>

                <div class="contact-advisor-intro">
                    <div class="online-badge">
                        <span class="online-dot" aria-hidden="true"></span>
                        Advisors online <span aria-hidden="true">·</span> Replies within 2 hours
                    </div>
                    <h2>Speak with a local advisor</h2>
                    <p>Personal guidance for your next move, from the first conversation to your site visit.</p>
                </div>

                <div class="contact-info-list" role="list">

                    <div class="contact-info-block" role="listitem">
                        <div class="info-icon" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div class="info-content">
                            <div class="contact-info-label">Head Sales Office</div>
                            <div class="contact-info-value">SG Highway Flagship</div>
                            <div class="contact-info-sub">
                                Bodakdev, Ahmedabad, Gujarat 380054<br>
                                <a href="https://maps.google.com/?q=SG+Highway+Bodakdev+Ahmedabad+Gujarat" target="_blank" rel="noopener noreferrer">Open in Google Maps →</a>
                            </div>
                        </div>
                    </div>

                    <div class="contact-info-block" role="listitem">
                        <div class="info-icon" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.62 3.38 2 2 0 0 1 3.59 1.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.72a16 16 0 0 0 7.37 7.37l1.06-.97a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div class="info-content">
                            <div class="contact-info-label">Call Us</div>
                            <div class="contact-info-value"><a href="tel:+919876543210">+91 98765 43210</a></div>
                            <div class="contact-info-sub">Mon–Sat: 9:30 AM – 7:30 PM IST</div>
                        </div>
                    </div>

                    <div class="contact-info-block" role="listitem">
                        <div class="info-icon" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div class="info-content">
                            <div class="contact-info-label">Direct Email</div>
                            <div class="contact-info-value contact-email-value"><a href="mailto:info@velorahomes.in">info@velorahomes.in</a></div>
                            <div class="contact-info-sub">We reply within 1 business day</div>
                        </div>
                    </div>

                </div>

                <a href="https://wa.me/919876543210?text=Hello%2C%20I%20am%20interested%20in%20a%20property%20enquiry."
                   class="whatsapp-btn"
                   target="_blank"
                   rel="noopener noreferrer"
                   aria-label="Send WhatsApp message to VELORA HOMES">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
                    </svg>
                    WhatsApp Concierge
                </a>

                <a href="{{ route('contact') }}?interest=site_visit#enquiry-form" class="contact-visit-link">
                    <span>
                        <strong>Prefer to meet in person?</strong>
                        <small>Request a private site visit</small>
                    </span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>

            </div>

            {{-- ══ RIGHT: Inquiry Form ══ --}}
            <div class="contact-form-card reveal" id="enquiry-form">
                <h2 class="form-title">Send an Enquiry</h2>
                <p class="form-subtitle">Fill in the details below and a dedicated advisor will reach out to you shortly.</p>

                @if(session('success'))
                    <div class="success-banner" role="alert">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="flex-shrink:0;color:#166534;margin-top:1px;"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.submit') }}" novalidate>
                    @csrf
                    @if(request('unit'))
                        <input type="hidden" name="unit" value="{{ request('unit') }}">
                    @endif

                    <div class="form-group">
                        <label class="form-label" for="name">Full Name</label>
                        <input id="name" name="name" type="text"
                               class="form-input"
                               value="{{ old('name') }}"
                               placeholder="e.g. Rajesh Patel"
                               required autocomplete="name">
                        @error('name')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <input id="email" name="email" type="email"
                               class="form-input"
                               value="{{ old('email') }}"
                               placeholder="you@domain.com"
                               required autocomplete="email">
                        @error('email')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="phone">Phone / WhatsApp</label>
                        <div class="phone-input-row">
                            <span class="phone-prefix">🇮🇳 +91</span>
                            <input id="phone" name="phone" type="tel"
                                   class="phone-field"
                                   value="{{ old('phone') }}"
                                   placeholder="98765 43210"
                                   autocomplete="tel">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" style="display:block;margin-bottom:10px;">Interested In</label>
                        <div class="interest-pills" role="group" aria-label="Select your interest">
                            @foreach(['Buying' => 'buying', 'Selling' => 'selling', 'Private Advisory' => 'advisory', 'Site Visit' => 'site_visit'] as $label => $val)
                            <label class="interest-pill {{ old('interest') === $val ? 'active' : '' }}"
                                   onclick="togglePill(this)">
                                <input type="radio" name="interest" value="{{ $val }}"
                                       {{ old('interest', request('interest')) === $val ? 'checked' : '' }}>
                                {{ $label }}
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="message">How can we help you?</label>
                        <textarea id="message" name="message"
                                  class="form-textarea"
                                  placeholder="Tell us about the property you're looking for, or describe what you'd like to sell or discuss."
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="form-submit">
                        Request Private Consultation
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function togglePill(selectedPill) {
    document.querySelectorAll('.interest-pill').forEach(pill => pill.classList.remove('active'));
    selectedPill.classList.add('active');
}

document.querySelectorAll('.interest-pill input:checked').forEach(input => {
    input.closest('.interest-pill').classList.add('active');
});
</script>
@endpush
