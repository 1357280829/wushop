<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  商品sku表
        Schema::create('product_skus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->comment('商品id');
            $table->json('product_param_ids')->comment('商品规格ids');
            $table->unsignedTinyInteger('is_enable')->default(1)->comment('是否已开启');
            $table->unsignedInteger('stock')->default(0)->comment('当前库存量');
            $table->decimal('sale_price', 10, 2)->default(0)->comment('销售价');
            $table->decimal('cost_price', 10, 2)->default(0)->comment('成本价');
            $table->text('desc')->nullable()->comment('商品sku描述');
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
        Schema::dropIfExists('product_skus');
    }
}
