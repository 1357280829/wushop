<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  订单商品表
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->comment('订单id');
            $table->unsignedBigInteger('product_id')->comment('商品id');
            $table->unsignedBigInteger('product_sku_id')->default(0)->comment('商品SKUid');
            $table->unsignedInteger('number')->default(1)->comment('已选数量');
            $table->json('product')->nullable()->comment('商品快照');
            $table->json('product_sku')->nullable()->comment('商品SKU快照');
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
        Schema::dropIfExists('order_products');
    }
}
