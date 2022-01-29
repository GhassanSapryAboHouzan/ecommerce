<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class PaymentMethod extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    /*** searchable */
    protected $searchable = [
        'columns' => [
            'payment_methods.name' => 10,
            'payment_methods.code' => 10,
            'payment_methods.merchant_email' => 10,
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

    /// Featured accessors
    public function getSandboxAttribute($value)
    {
        if ($value == 0) {
            return __('common.live');
        } else {
            return __('common.sandbox');
        }
    }


}
