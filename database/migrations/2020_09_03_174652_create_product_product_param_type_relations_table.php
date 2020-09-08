<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductProductParamTypeRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  商品和商品规格类型关联表
        Schema::create('product_product_param_type_relations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->comment('商品id');
            $table->unsignedBigInteger('product_param_type_id')->comment('商品规格类型id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_product_param_type_relations');
    }
}
