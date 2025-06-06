<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class HostingSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'video_button_text',
        'video_url',
        'background_image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active hosting sections
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered hosting sections
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Get the full background image URL
     */
    public function getBackgroundImageUrlAttribute(): ?string
    {
        if (!$this->background_image) {
            return null;
        }

        if (str_starts_with($this->background_image, 'http')) {
            return $this->background_image;
        }

        return storage_asset($this->background_image);
    }

    /**
     * Delete associated image when model is deleted
     */
    protected static function booted(): void
    {
        static::deleting(function (HostingSection $hostingSection) {
            if ($hostingSection->background_image && !str_starts_with($hostingSection->background_image, 'http')) {
                Storage::delete($hostingSection->background_image);
            }
        });
    }
}
