<?php

namespace App\Models\Traits\Freight;

use Illuminate\Support\Facades\Cache;

trait GlobalFreightSetting
{
    //  获取 全局运费设置
    public static function getGlobalFreightSetting()
    {
        return [
            'is_free' => Cache::get('global_freight_setting-is_free', 1),
            'global_price' => Cache::get('global_freight_setting-global_price', 0.00),
        ];
    }
}