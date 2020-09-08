<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSku extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id', 'product_param_ids', 'is_enable', 'stock', 'sale_price', 'cost_price', 'desc',
    ];

    protected $casts = [
        'product_param_ids' => 'json',
    ];

    //  商品
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
