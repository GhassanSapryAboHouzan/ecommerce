<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Nicolaslopezj\Searchable\SearchableTrait;

class ProductReview extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];


    /*** searchable */
    protected $searchable = [
        'columns' => [
            'product_reviews.name' => 10,
            'product_reviews.email' => 10,
            'product_reviews.title' => 10,
            'product_reviews.message' => 10,
        ],
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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

}
