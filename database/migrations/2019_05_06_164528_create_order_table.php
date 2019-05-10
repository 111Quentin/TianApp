<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id')->comment('主键ID');
            $table->integer('member_id')->comment('会员ID');
            $table -> string('mobile',11)->comment('收货人联系方式');//手机号，varchar(11)
            $table->string('adderss')->comment('收货地点');
            $table->decimal('total_price',10,2)->comment('订单总价格');
            $table -> enum('pay_status',[0,1]) -> notNull() ->default('0')->comment('支付状态'); //支付状态，0=未支付，1=已支付
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
