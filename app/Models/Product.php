<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use HasFactory, Sluggable, SearchableTrait;

    protected $guarded = [];

    /*** Return the sluggable configuration array for this model. */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /*** searchable */
    protected $searchable = [
        'columns' => [
            'products.name' => 10,
        ],
    ];

    //////////////////////////////////////////////////////////////////
    /// Relations
    public function category():BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }


    public function firstMedia(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable')->orderBy('file_sort', 'asc');
    }


    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }


    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    //////////////////////////////////// Scopes ///////////////////////
    /// Featured Scopes
    public function scopeFeatured($query)
    {
        return $query->whereFeatured(true);
    }

    /// Active Status Scopes
    public function scopeActive($query)
    {
        return $query->whereStatus(true);
    }

    /// Inactive Status Scopes
    public function scopeInactive($query)
    {
        return $query->whereStatus(false);
    }

    /// Has Quantity Scopes
    public function scopeHasQuantity($query)
    {
        return $query->where('quantity', '>', 0);
    }

    public function scopeActiveCategory($query)
    {
        return $query->whereHas('category', function ($query) {
            $query->whereStatus(1);
        });
    }
    //////////////////////////////////// accessors ///////////////////////
    /// Status accessors
    public function getStatusAttribute($value)
    {
        if ($value == 0) {
            return __('common.inactive');
        } else {
            return __('common.active');
        }
    }

    /// Featured accessors
    public function getFeaturedAttribute($value)
    {
        if ($value == 0) {
            return __('common.no');
        } else {
            return __('common.yes');
        }
    }
}
