<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'interest',
        'message',
        'unit',
        'status',
    ];

    /**
     * Get a human-readable interest label.
     */
    public function getInterestLabelAttribute(): string
    {
        return match ($this->interest) {
            'buying' => 'Buying',
            'selling' => 'Selling',
            'advisory' => 'Private Advisory',
            'site_visit' => 'Site Visit',
            default => ucfirst($this->interest ?? 'General'),
        };
    }

    /**
     * Get the status badge colour class.
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'new' => 'admin-badge-new',
            'read' => 'admin-badge-read',
            'replied' => 'admin-badge-replied',
            default => 'admin-badge-new',
        };
    }
}
