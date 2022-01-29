<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class ShippingCompany extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];
    /*** searchable */
    protected $searchable = [
        'columns' => [
            'shipping_companies.name' => 10,
            'shipping_companies.code' => 10,
            'shipping_companies.description' => 10,
        ],
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
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

    /// Fast accessors
    public function getFastAttribute($value)
    {
        if ($value == 0) {
            return __('common.no');
        } else {
            return __('common.yes');
        }
    }


    //////////////////////////////////// relationships ///////////////////////
    /// countries
    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'shipping_company_country');
    }
}
