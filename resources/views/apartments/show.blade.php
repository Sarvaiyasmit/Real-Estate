@extends('layouts.app')

@section('title', 'Home Unit '.$apartment->unit_number.' — VELORA HOMES Gujarat')
@section('meta_description', $apartment->typology_label.' in Gujarat, India. '.$apartment->bedrooms.' bedrooms, '.$apartment->area_sqft.' sq. ft.')

@push('styles')
    <link rel="stylesheet" href="/css/apartments.css">
@endpush

@section('content')

<div class="unit-header">
    <div class="container">
        <div class="unit-header-inner">
            <div>
                <div class="unit-breadcrumb">
                    <a href="{{ route('apartments.index') }}">Browse Homes</a> &nbsp;/&nbsp; Unit {{ $apartment->unit_number }}
                </div>
                <span class="unit-type-tag">{{ $apartment->typology_label }}</span>
                <h1>Home Unit {{ $apartment->unit_number }}</h1>
            </div>
            <div style="text-align:right;">
                <div style="font-size:13px;color:rgba(255,255,255,0.6);margin-bottom:4px;">Tower Block {{ $apartment->block }} · Floor {{ $apartment->floor }}</div>
                <div style="font-family:'Cormorant Garamond',serif;font-size:36px;color:white;">{{ $apartment->bedrooms }} Bedrooms</div>
                <div style="font-size:14px;color:rgba(255,255,255,0.7);">{{ number_format($apartment->area_sqft) }} sq. ft. super built-up{{ $apartment->terrace_sqft > 0 ? ' + '.number_format($apartment->terrace_sqft).' sq. ft. balcony' : '' }}</div>
            </div>
        </div>
    </div>
</div>

<section class="unit-body">
    <div class="container">
        <a href="{{ route('apartments.index') }}" class="back-link">← Back to All Homes</a>
        
        <div class="unit-grid">
            <div>
                <img src="{{ $apartment->typology_image }}" alt="Home Unit {{ $apartment->unit_number }}" style="width:100%;height:420px;object-fit:cover;border-radius:6px;">
                
                <div style="margin-top:10px;display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                    <img src="/images/floorplan_penthouse.jpg" alt="Home Floor Plan" style="width:100%;height:200px;object-fit:cover;border-radius:6px;">
                    <img src="/images/amenities_pool.jpg" alt="Community Amenities" style="width:100%;height:200px;object-fit:cover;border-radius:6px;">
                </div>

                <div class="unit-desc">
                    <h3>About This Home</h3>
                    <p>This spacious {{ strtolower($apartment->typology_label) }} features {{ number_format($apartment->area_sqft) }} sq. ft. of luxury living space{{ $apartment->terrace_sqft > 0 ? ', plus a '.number_format($apartment->terrace_sqft).' sq. ft. private balcony' : '' }}. Situated on Floor {{ $apartment->floor }} of Tower Block {{ $apartment->block }}, it enjoys natural sunlight facing {{ $apartment->orientation ?? 'East' }}.</p>
                    <p style="margin-top:10px;">Includes modular kitchen fittings, vitrified tile flooring, video door phone security, electric vehicle charging point, and premium bath fixtures.</p>
                    @if($apartment->orientation)
                    <div class="orientation-badge">☀️ Vastu compliant {{ $apartment->orientation }} facing</div>
                    @endif
                </div>
            </div>

            <div class="unit-specs-card">
                <div class="unit-specs-title">Home Details</div>
                <table class="specs-table">
                    <tr><td>Home Unit</td><td>Unit {{ $apartment->unit_number }}</td></tr>
                    <tr><td>Configuration</td><td>{{ $apartment->typology_label }}</td></tr>
                    <tr><td>Tower Block</td><td>Block {{ $apartment->block }}</td></tr>
                    <tr><td>Floor Level</td><td>Floor {{ $apartment->floor }}</td></tr>
                    <tr><td>Bedrooms</td><td>{{ $apartment->bedrooms }} Beds</td></tr>
                    <tr><td>Super Built-up Area</td><td>{{ number_format($apartment->area_sqft) }} sq. ft.</td></tr>
                    @if($apartment->terrace_sqft > 0)
                    <tr><td>Balcony Area</td><td>{{ number_format($apartment->terrace_sqft) }} sq. ft.</td></tr>
                    @endif
                    @if($apartment->orientation)
                    <tr><td>Facing Direction</td><td>{{ $apartment->orientation }}</td></tr>
                    @endif
                    <tr><td>Status</td><td>{{ ucfirst($apartment->status) }}</td></tr>
                    <tr><td>Est. Price</td><td>{{ $apartment->formatted_price }}</td></tr>
                </table>
                <a href="{{ route('contact') }}?unit={{ $apartment->unit_number }}" class="unit-cta">Schedule Site Visit / Contact Us</a>
                <p class="no-pricing-note">We answer within 1 business day.</p>
            </div>
        </div>
    </div>
</section>

@endsection
