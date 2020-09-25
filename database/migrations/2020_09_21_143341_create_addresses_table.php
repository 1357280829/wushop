<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  收货地址表
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wechat_user_id')->comment('微信用户id');
            $table->string('consignee_name')->nullable()->comment('收货人名称');
            $table->string('consignee_phone')->nullable()->comment('收货人手机号');
            $table->string('province')->nullable()->comment('省');
            $table->string('city')->nullable()->comment('市');
            $table->string('area')->nullable()->comment('区');
            $table->string('detail')->nullable()->comment('详细地址');
            $table->string('nation_code')->nullable()->comment('收货地址国家码');
            $table->string('postal_code')->nullable()->comment('邮编');
            $table->unsignedTinyInteger('is_default')->default(0)->comment('是否为默认地址');
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
        Schema::dropIfExists('addresses');
    }
}
