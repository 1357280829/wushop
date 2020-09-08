<?php

namespace App\Models\Traits\Product;

use App\Models\ProductParam;
use Illuminate\Support\Arr;

trait SyncProductSku
{
    //  同步 商品sku
    public function syncProductSku(array $productParamTypeIds)
    {
        if ($this->wasRecentlyCreated || !array_equal($this->productParamTypes->modelKeys(), $productParamTypeIds)) {
            $this->productSkus()->forceDelete();
            $this->productSkus()
                ->createMany(array_map(function ($productParamIds) {
                    return [
                        'product_param_ids' => $productParamIds,
                        'stock' => $this->stock,
                        'sale_price' => $this->sale_price,
                        'cost_price' => $this->cost_price,
                    ];
                }, self::getProductParamIds($productParamTypeIds)));
        }
    }

    //  获取 商品规格ids(笛卡尔积)
    protected static function getProductParamIds(array $productParamTypeIds)
    {
        $productParams = ProductParam::query()
            ->whereIn('product_param_type_id', $productParamTypeIds)
            ->get()
            ->groupBy('product_param_type_id')
            ->each->transform(function ($productParam) {
                return $productParam->id;
            })
            ->values()
            ->toArray();

        return Arr::crossJoin(...$productParams);
    }
}