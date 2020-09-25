<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GlobalFreightSettingController extends Controller
{
    public function index()
    {
        return redirect('freights');
    }

    public function store(Request $request)
    {
        Cache::put('global_freight_setting-is_free', $request->is_free);

        if ($request->global_price) {
            Cache::put('global_freight_setting-global_price', $request->global_price);
        }
    }
}
