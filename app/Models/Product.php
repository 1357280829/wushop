<?php

namespace App\Models;

use App\Models\Traits\Product\SyncMinimumPrice;
use App\Models\Traits\Product\SyncProductSku;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, SyncProductSku, SyncMinimumPrice;

    protected $fillable = [
        'banner_urls', 'cover_url', 'name', 'desc', 'is_on', 'is_enable_sku', 'stock', 'sale_price', 'cost_price',
        'minimum_price', 'detail_introduction', 'detail_after_sale', 'sort', 'on_at',
    ];

    protected $casts = [
        'banner_urls' => 'json',
    ];

    //  分类
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product_relations');
    }

    //  商品规格类型
    public function productParamTypes()
    {
        return $this->belongsToMany(ProductParamType::class, 'product_product_param_type_relations');
    }

    //  商品sku
    public function productSkus()
    {
        return $this->hasMany(ProductSku::class, 'product_id', 'id');
    }

    //  修改器 是否上架
    public function setIsOnAttribute($value)
    {
        //  更新上架时间
        if ($value) {
            $this->attributes['on_at'] = now();
        }

        $this->attributes['is_on'] = $value;
    }
}
