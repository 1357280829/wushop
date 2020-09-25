<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  分类表
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名称');
            $table->string('cover_url')->nullable()->comment('封面url');
            $table->unsignedBigInteger('parent_id')->default(0)->comment('父级id');
            $table->unsignedInteger('sort')->default(0)->comment('自定义排序值');
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
        Schema::dropIfExists('categories');
    }
}
