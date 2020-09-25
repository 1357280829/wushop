<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  运费表
        Schema::create('freights', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 10, 2)->default(0.00)->comment('价格');
            $table->unsignedTinyInteger('is_free')->default(0)->comment('是否免运费');
            $table->string('province')->nullable()->comment('省');
            $table->string('city')->nullable()->comment('市');
            $table->string('area')->nullable()->comment('区');
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
        Schema::dropIfExists('freights');
    }
}
