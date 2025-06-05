<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'currency',
        'tent_type',
        'tent_quantity',
        'main_image',
        'image_1',
        'image_2',
        'image_3',
        'max_occupancy',
        'features',
        'sort_order',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'tent_quantity' => 'integer',
        'max_occupancy' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'features' => 'array',
    ];

    /**
     * Scope for active room types
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured room types
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for ordered room types
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Get the formatted price
     */
    public function getFormattedPriceAttribute(): string
    {
        return $this->currency . ' ' . number_format($this->price, 0);
    }

    /**
     * Get the tent configuration description
     */
    public function getTentConfigurationAttribute(): string
    {
        if ($this->tent_quantity === 1) {
            return "1 {$this->tent_type}";
        }
        
        return "{$this->tent_quantity} {$this->tent_type}";
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
     * Get the full image_1 URL
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
     * Get the full image_2 URL
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
     * Get the full image_3 URL
     */
    public function getImage3UrlAttribute(): ?string
    {
        if (!$this->image_3) {
            return null;
        }

        if (str_starts_with($this->image_3, 'http')) {
            return $this->image_3;
        }

        return Storage::url($this->image_3);
    }

    /**
     * Delete associated images when model is deleted
     */
    protected static function booted(): void
    {
        static::deleting(function (RoomType $roomType) {
            foreach (['main_image', 'image_1', 'image_2', 'image_3'] as $imageField) {
                if ($roomType->$imageField && !str_starts_with($roomType->$imageField, 'http')) {
                    Storage::disk('public')->delete($roomType->$imageField);
                }
            }
        });
    }
}
