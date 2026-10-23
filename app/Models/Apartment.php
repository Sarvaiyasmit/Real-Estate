<?php

namespace App\Models;

use Database\Factories\ApartmentFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    /** @use HasFactory<ApartmentFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'unit_number',
        'typology',
        'block',
        'floor',
        'bedrooms',
        'area_sqm',
        'terrace_sqm',
        'orientation',
        'status',
        'completion_date',
        'image',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'completion_date' => 'date',
        'area_sqm' => 'decimal:2',
        'terrace_sqm' => 'decimal:2',
    ];

    /**
     * Get the human-readable typology label (Gujarat/India real estate terminology).
     */
    public function getTypologyLabelAttribute(): string
    {
        return match ($this->typology) {
            'ground_garden' => '3 BHK Garden Villa',
            'ground_basement' => '4 BHK Duplex Flat',
            'penthouse_duplex' => '5 BHK Sky Penthouse',
            default => ucfirst(str_replace('_', ' ', $this->typology)),
        };
    }

    /**
     * Get price formatted in Indian Rupees (INR Lakhs / Crores).
     */
    public function getFormattedPriceAttribute(): string
    {
        // Estimate price based on area in sq. ft. (area_sqm * 10.764)
        $sqft = $this->area_sqm * 10.764;
        $priceInRupees = $sqft * 6500; // ~₹6,500 per sq ft average in Prime Gujarat

        if ($priceInRupees >= 10000000) {
            return '₹ '.number_format($priceInRupees / 10000000, 2).' Cr';
        } else {
            return '₹ '.number_format($priceInRupees / 100000, 2).' Lakh';
        }
    }

    /**
     * Get total area converted to Square Feet (sq. ft.).
     */
    public function getAreaSqftAttribute(): int
    {
        return (int) round($this->area_sqm * 10.764);
    }

    /**
     * Get terrace area converted to Square Feet (sq. ft.).
     */
    public function getTerraceSqftAttribute(): int
    {
        return (int) round(($this->terrace_sqm ?? 0) * 10.764);
    }

    /**
     * Get a unique, distinct image path for each residence.
     */
    public function getTypologyImageAttribute(): string
    {
        if (! empty($this->image)) {
            return $this->image;
        }

        $images = [
            '/images/villa_modern.jpg',
            '/images/apartment_penthouse.jpg',
            '/images/interior_penthouse.jpg',
            '/images/apartment_ground.jpg',
            '/images/rooftop_view.jpg',
            '/images/apartment_duplex.jpg',
            '/images/amenities_pool.jpg',
            '/images/lifestyle_wellness.jpg',
        ];

        $unitNum = (int) preg_replace('/\D/', '', (string) ($this->unit_number ?? $this->id ?? '1'));
        $index = $unitNum % count($images);

        return $images[$index];
    }

    /**
     * Scope a query to filter by typology.
     *
     * @param  Builder  $query
     */
    public function scopeOfTypology($query, string $typology)
    {
        return $query->where('typology', $typology);
    }

    /**
     * Scope to only available apartments.
     *
     * @param  Builder  $query
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }
}
