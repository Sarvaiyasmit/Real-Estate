@extends('admin.layouts.app')
@section('title', $apartment->exists ? 'Edit Apartment' : 'Add Apartment')
@section('page_title', $apartment->exists ? 'Edit Apartment — Unit '.$apartment->unit_number : 'Add Apartment')

@section('content')

<div style="max-width:860px;">

    <div style="margin-bottom:16px;">
        <a href="{{ route('admin.apartments.index') }}" class="admin-btn admin-btn-ghost admin-btn-sm">← Back to Apartments</a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <span class="admin-card-title">{{ $apartment->exists ? 'Edit details' : 'New apartment' }}</span>
        </div>

        <form method="POST"
              action="{{ $apartment->exists ? route('admin.apartments.update', $apartment) : route('admin.apartments.store') }}">
            @csrf
            @if($apartment->exists) @method('PUT') @endif

            <div class="admin-form-grid">

                <div class="admin-form-group">
                    <label class="admin-form-label" for="unit_number">Unit Number *</label>
                    <input id="unit_number" name="unit_number" type="text"
                           class="admin-form-input"
                           value="{{ old('unit_number', $apartment->unit_number) }}"
                           placeholder="e.g. 12A" required>
                    @error('unit_number')<span class="admin-form-error">{{ $message }}</span>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="typology">Typology *</label>
                    <select id="typology" name="typology" class="admin-form-select" required>
                        <option value="">— Select —</option>
                        @foreach(['ground_garden' => '3 BHK Garden Villa', 'ground_basement' => '4 BHK Duplex Flat', 'penthouse_duplex' => '5 BHK Sky Penthouse'] as $val => $label)
                            <option value="{{ $val }}" {{ old('typology', $apartment->typology) === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('typology')<span class="admin-form-error">{{ $message }}</span>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="block">Block *</label>
                    <select id="block" name="block" class="admin-form-select" required>
                        <option value="">— Select —</option>
                        @foreach(['A','B','C'] as $b)
                            <option value="{{ $b }}" {{ old('block', $apartment->block) === $b ? 'selected' : '' }}>Block {{ $b }}</option>
                        @endforeach
                    </select>
                    @error('block')<span class="admin-form-error">{{ $message }}</span>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="floor">Floor *</label>
                    <input id="floor" name="floor" type="number" min="0" max="30"
                           class="admin-form-input"
                           value="{{ old('floor', $apartment->floor) }}"
                           placeholder="0" required>
                    @error('floor')<span class="admin-form-error">{{ $message }}</span>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="bedrooms">Bedrooms *</label>
                    <input id="bedrooms" name="bedrooms" type="number" min="1" max="10"
                           class="admin-form-input"
                           value="{{ old('bedrooms', $apartment->bedrooms) }}"
                           placeholder="3" required>
                    @error('bedrooms')<span class="admin-form-error">{{ $message }}</span>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="area_sqm">Area (sqm) *</label>
                    <input id="area_sqm" name="area_sqm" type="number" min="20" step="0.01"
                           class="admin-form-input"
                           value="{{ old('area_sqm', $apartment->area_sqm) }}"
                           placeholder="150.00" required>
                    @error('area_sqm')<span class="admin-form-error">{{ $message }}</span>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="terrace_sqm">Terrace (sqm)</label>
                    <input id="terrace_sqm" name="terrace_sqm" type="number" min="0" step="0.01"
                           class="admin-form-input"
                           value="{{ old('terrace_sqm', $apartment->terrace_sqm) }}"
                           placeholder="0.00">
                    @error('terrace_sqm')<span class="admin-form-error">{{ $message }}</span>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="orientation">Orientation</label>
                    <input id="orientation" name="orientation" type="text"
                           class="admin-form-input"
                           value="{{ old('orientation', $apartment->orientation) }}"
                           placeholder="e.g. South-East">
                    @error('orientation')<span class="admin-form-error">{{ $message }}</span>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="status">Status *</label>
                    <select id="status" name="status" class="admin-form-select" required>
                        @foreach(['available','reserved','sold'] as $s)
                            <option value="{{ $s }}" {{ old('status', $apartment->status ?? 'available') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    @error('status')<span class="admin-form-error">{{ $message }}</span>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="completion_date">Completion Date</label>
                    <input id="completion_date" name="completion_date" type="date"
                           class="admin-form-input"
                           value="{{ old('completion_date', $apartment->completion_date?->format('Y-m-d')) }}">
                    @error('completion_date')<span class="admin-form-error">{{ $message }}</span>@enderror
                </div>

                <div class="admin-form-group admin-form-span-2">
                    <label class="admin-form-label" for="image">Image Path</label>
                    <input id="image" name="image" type="text"
                           class="admin-form-input"
                           value="{{ old('image', $apartment->image) }}"
                           placeholder="/images/villa_modern.jpg">
                    @error('image')<span class="admin-form-error">{{ $message }}</span>@enderror
                </div>

                <div class="admin-form-group admin-form-span-2">
                    <label class="admin-form-label" for="description">Description</label>
                    <textarea id="description" name="description"
                              class="admin-form-textarea"
                              placeholder="Optional description...">{{ old('description', $apartment->description) }}</textarea>
                    @error('description')<span class="admin-form-error">{{ $message }}</span>@enderror
                </div>

            </div>

            <div class="admin-form-actions">
                <button type="submit" class="admin-btn admin-btn-primary">
                    {{ $apartment->exists ? 'Save Changes' : 'Create Apartment' }}
                </button>
                <a href="{{ route('admin.apartments.index') }}" class="admin-btn admin-btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
