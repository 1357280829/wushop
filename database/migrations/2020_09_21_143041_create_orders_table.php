<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  订单表
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wechat_user_id')->comment('微信用户id');
            $table->string('no')->comment('订单编号');
            $table->unsignedTinyInteger('status')->default(1)->comment('订单状态;1:待付款,2:待发货,3:待收货,4:已完成,5:已取消,6:已退款');
            $table->decimal('freight_price', 10, 2)->default(0.00)->comment('运费');
            $table->decimal('total_sale_price', 10, 2)->default(0.00)->comment('商品总销售价');
            $table->decimal('actual_price', 10, 2)->default(0.00)->comment('商品合计价(最终实付价)');
            $table->text('remark')->nullable()->comment('买家留言');
            $table->json('address')->comment('收货地址快照');
            $table->json('wechat_user')->comment('微信用户快照');
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
        Schema::dropIfExists('orders');
    }
}
