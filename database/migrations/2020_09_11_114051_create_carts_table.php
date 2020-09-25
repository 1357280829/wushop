<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  购物车表
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wechat_user_id')->comment('微信用户id');
            $table->unsignedBigInteger('product_id')->comment('商品id');
            $table->unsignedBigInteger('product_sku_id')->default(0)->comment('商品SKUid');
            $table->unsignedInteger('number')->default(1)->comment('已选数量');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
