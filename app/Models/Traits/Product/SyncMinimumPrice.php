<?php

namespace App\Models\Traits\Product;

trait SyncMinimumPrice
{
    //  同步 最低价格
    public function syncMinimumPrice()
    {
        $this->minimum_price = $this->productSkus()
            ->pluck('sale_price')
            ->push($this->sale_price)
            ->min();
        $this->save();
    }
}