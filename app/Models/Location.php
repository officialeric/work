<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'additional_description',
        'image_1',
        'image_2',
        'image_3',
        'button_text',
        'button_link',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active locations
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered locations
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Get the full image URL for image_1
     */
    public function getImage1UrlAttribute(): ?string
    {
        if (!$this->image_1) {
            return null;
        }

        if (str_starts_with($this->image_1, 'http')) {
            return $this->image_1;
        }

        return storage_asset($this->image_1);
    }

    /**
     * Get the full image URL for image_2
     */
    public function getImage2UrlAttribute(): ?string
    {
        if (!$this->image_2) {
            return null;
        }

        if (str_starts_with($this->image_2, 'http')) {
            return $this->image_2;
        }

        return storage_asset($this->image_2);
    }

    /**
     * Get the full image URL for image_3
     */
    public function getImage3UrlAttribute(): ?string
    {
        if (!$this->image_3) {
            return null;
        }

        if (str_starts_with($this->image_3, 'http')) {
            return $this->image_3;
        }

        return storage_asset($this->image_3);
    }

    /**
     * Delete associated images when model is deleted
     */
    protected static function booted(): void
    {
        static::deleting(function (Location $location) {
            foreach (['image_1', 'image_2', 'image_3'] as $imageField) {
                if ($location->$imageField && !str_starts_with($location->$imageField, 'http')) {
                    Storage::delete($location->$imageField);
                }
            }
        });
    }
}
