<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'alt_text',
        'image_path',
        'thumbnail_path',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active images
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered images
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Get the full image URL
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image_path) {
            return null;
        }

        if (str_starts_with($this->image_path, 'http')) {
            return $this->image_path;
        }

        return storage_asset($this->image_path);
    }

    /**
     * Get the full thumbnail URL
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if (!$this->thumbnail_path) {
            return $this->image_url;
        }

        if (str_starts_with($this->thumbnail_path, 'http')) {
            return $this->thumbnail_path;
        }

        return storage_asset($this->thumbnail_path);
    }

    /**
     * Delete associated files when model is deleted
     */
    protected static function booted(): void
    {
        static::deleting(function (GalleryImage $image) {
            if ($image->image_path && !str_starts_with($image->image_path, 'http')) {
                Storage::delete($image->image_path);
            }
            
            if ($image->thumbnail_path && !str_starts_with($image->thumbnail_path, 'http')) {
                Storage::delete($image->thumbnail_path);
            }
        });
    }
}
