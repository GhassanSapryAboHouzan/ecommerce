<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class ProductCoupon extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];
    protected $dates = ['start_date', 'expire_date'];

    /*** searchable */
    protected $searchable = [
        'columns' => [
            'product_coupons.code' => 10,
            'product_coupons.description' => 10,
        ],
    ];

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

    ///////////////////////////////////////////////////////////
    /// checkDate
    protected function checkDate()
    {
        if ($this->expire_date != '') {
            if (Carbon::now()->between($this->start_date, $this->expire_date, true)) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
    ///////////////////////////////////////////////////////////
    /// checkUsedTimes
    protected function checkUsedTimes()
    {
        if ($this->use_times != '') {
            if ($this->use_times > $this->used_times) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    //////////////////////////////////// ///////////////////////
    /// checkGratherThan
    protected function checkGreaterThan($total)
    {
        if ($this->greater_than != '') {
            if ($total >= $this->greater_than) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    //////////////////////////////////// ///////////////////////
    /// checkType
    protected function checkType($total)
    {
        switch ($this->type) {
            case 'fixed':
                return $this->value;
            case 'percentage':
                return ($this->value / 100) * $total;
            default :
                return 0;
        }
    }

    //////////////////////////////////// ///////////////////////
    /// discount
    public function discount($total)
    {
        if (!$this->checkDate() || !$this->checkUsedTimes()){
            return 0;
        }

        return $this->checkGreaterThan($total) ? $this->checkType($total) : 0;
    }

}
