<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  商品规格表
        Schema::create('product_params', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名称');
            $table->unsignedBigInteger('product_param_type_id')->comment('商品规格类型id');
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
        Schema::dropIfExists('product_params');
    }
}
