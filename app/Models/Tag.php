<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class Tag extends Model
{
    use HasFactory, Sluggable,SearchableTrait;

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
            'tags.name' => 10,
        ],
    ];

    //////////////////////////////////////////////////////////////////
    /// Relations

    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'taggable');
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
