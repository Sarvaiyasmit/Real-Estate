@extends('layouts.app')

@section('title', 'Browse Homes in Gujarat — VELORA HOMES')
@section('meta_description', 'Browse available luxury homes, apartments, villas, and penthouses in Ahmedabad, Surat, Vadodara, and Rajkot, Gujarat.')

@push('styles')
    <link rel="stylesheet" href="/css/apartments.css">
@endpush

@section('content')

<div class="page-header">
    <span class="label-small" style="color:var(--terracotta)">Available Listings in Gujarat</span>
    <h1>Find Your Ideal Home</h1>
    <p>{{ $apartments->count() }} home{{ $apartments->count() !== 1 ? 's' : '' }} available across Gujarat</p>
</div>

<div class="filter-bar">
    <div class="container">
        <form method="GET" action="{{ route('apartments.index') }}" class="filter-inner" id="filter-form">
            <select name="typology" class="filter-select" onchange="this.form.submit()">
                <option value="">All Home Configurations</option>
                <option value="ground_garden" {{ request('typology') === 'ground_garden' ? 'selected' : '' }}>3 BHK Garden Villa</option>
                <option value="ground_basement" {{ request('typology') === 'ground_basement' ? 'selected' : '' }}>4 BHK Duplex Flat</option>
                <option value="penthouse_duplex" {{ request('typology') === 'penthouse_duplex' ? 'selected' : '' }}>5 BHK Sky Penthouse</option>
            </select>
            <select name="bedrooms" class="filter-select" onchange="this.form.submit()">
                <option value="">Any Bedrooms</option>
                @foreach([2,3,4,5] as $b)
                    <option value="{{ $b }}" {{ request('bedrooms') == $b ? 'selected' : '' }}>{{ $b }} Bedrooms</option>
                @endforeach
            </select>
            <select name="sort" class="filter-select" onchange="this.form.submit()">
                <option value="area_asc" {{ request('sort','area_asc') === 'area_asc' ? 'selected' : '' }}>Area: Smallest first</option>
                <option value="area_desc" {{ request('sort') === 'area_desc' ? 'selected' : '' }}>Area: Largest first</option>
            </select>
            @if(request('typology') || request('bedrooms'))
                <a href="{{ route('apartments.index') }}" class="filter-reset">Clear Filters ×</a>
            @endif
            <span class="filter-count">{{ $apartments->count() }} result{{ $apartments->count() !== 1 ? 's' : '' }}</span>
        </form>
    </div>
</div>

<section class="apartments-section">
    <div class="container">
        @if($apartments->isEmpty())
            <div class="empty-state">
                <h3>No homes match your search</h3>
                <p style="margin-bottom:20px;">Try clearing your filters to see all available homes in Gujarat.</p>
                <a href="{{ route('apartments.index') }}" class="btn-primary">Show All Homes</a>
            </div>
        @else
            <div class="apt-grid">
                @foreach($apartments as $apartment)
                <div class="apt-card reveal">
                    <div class="apt-card-img">
                        <img src="{{ $apartment->typology_image }}" alt="{{ $apartment->typology_label }}" loading="lazy">
                        <span class="apt-card-badge {{ $apartment->status === 'reserved' ? 'reserved' : '' }}">
                            {{ ucfirst($apartment->status) }}
                        </span>
                    </div>
                    <div class="apt-card-body">
                        <div class="apt-card-type">{{ $apartment->typology_label }}</div>
                        <div class="apt-card-unit">Home Unit {{ $apartment->unit_number }}</div>
                        <div class="apt-card-specs">
                            <div class="apt-spec-item">Tower Block &amp; Floor<span class="apt-spec-val">Block {{ $apartment->block }}, Floor {{ $apartment->floor }}</span></div>
                            <div class="apt-spec-item">Bedrooms<span class="apt-spec-val">{{ $apartment->bedrooms }} Beds</span></div>
                            <div class="apt-spec-item">Built-up Area<span class="apt-spec-val">{{ number_format($apartment->area_sqft) }} sq. ft.</span></div>
                            <div class="apt-spec-item">Balcony / Terrace<span class="apt-spec-val">{{ $apartment->terrace_sqft > 0 ? number_format($apartment->terrace_sqft).' sq. ft.' : '—' }}</span></div>
                        </div>
                        <div class="apt-card-footer">
                            <div style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;color:var(--dark);">
                                {{ $apartment->formatted_price }}
                            </div>
                            <a href="{{ route('apartments.show', $apartment) }}" class="apt-enquire">View Details →</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        <div class="help-banner">
            <span class="label-small" style="color:var(--terracotta)">Need Assistance?</span>
            <h2>Looking for your dream property in Gujarat?</h2>
            <p>Our experienced local property consultants in Ahmedabad &amp; Surat will gladly schedule site visits and answer all your questions.</p>
            <a href="{{ route('contact') }}" class="btn-primary">Contact Us Now</a>
        </div>
    </div>
</section>

@endsection
