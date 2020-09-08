<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ProductParamType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    //  商品规格
    public function params()
    {
        return $this->hasMany(ProductParam::class, 'product_param_type_id', 'id');
    }
}
