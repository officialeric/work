<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class AccommodationSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'main_image',
        'image_1',
        'image_2',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active accommodation sections
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered accommodation sections
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Get the full main image URL
     */
    public function getMainImageUrlAttribute(): ?string
    {
        if (!$this->main_image) {
            return null;
        }

        if (str_starts_with($this->main_image, 'http')) {
            return $this->main_image;
        }

        return Storage::url($this->main_image);
    }

    /**
     * Get the full image 1 URL
     */
    public function getImage1UrlAttribute(): ?string
    {
        if (!$this->image_1) {
            return null;
        }

        if (str_starts_with($this->image_1, 'http')) {
            return $this->image_1;
        }

        return Storage::url($this->image_1);
    }

    /**
     * Get the full image 2 URL
     */
    public function getImage2UrlAttribute(): ?string
    {
        if (!$this->image_2) {
            return null;
        }

        if (str_starts_with($this->image_2, 'http')) {
            return $this->image_2;
        }

        return Storage::url($this->image_2);
    }

    /**
     * Delete associated images when model is deleted
     */
    protected static function booted(): void
    {
        static::deleting(function (AccommodationSection $accommodationSection) {
            foreach (['main_image', 'image_1', 'image_2'] as $imageField) {
                if ($accommodationSection->$imageField && !str_starts_with($accommodationSection->$imageField, 'http')) {
                    Storage::disk('public')->delete($accommodationSection->$imageField);
                }
            }
        });
    }
}
