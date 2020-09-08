<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  商品表
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->json('banner_urls')->nullable()->comment('轮播图');
            $table->string('cover_url')->nullable()->comment('封面url');
            $table->string('name')->comment('商品名');
            $table->longText('desc')->nullable()->comment('商品描述');
            $table->unsignedTinyInteger('is_on')->default(0)->comment('是否上架');
            $table->unsignedTinyInteger('is_enable_sku')->default(0)->comment('是否开启sku');
            $table->unsignedInteger('stock')->default(0)->comment('当前库存量');
            $table->decimal('sale_price', 10, 2)->default(0.00)->comment('销售价');
            $table->decimal('cost_price', 10, 2)->default(0.00)->comment('成本价');
            $table->decimal('minimum_price', 10, 2)->default(0.00)->comment('最低价');
            $table->longText('detail_introduction')->nullable()->comment('商品介绍');
            $table->longText('detail_after_sale')->nullable()->comment('售后保障');
            $table->unsignedInteger('sort')->default(0)->comment('自定义排序值');
            $table->timestamp('on_at')->nullable()->comment('上架时间');
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
        Schema::dropIfExists('products');
    }
}
