<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id')->comment('主键ID');
            $table->integer('goods_sn')->comment('商品货号');
            $table->string('goods_name',40)->comment('商品名称');
            $table->integer('goods_nums')->comment('商品库存');
            $table->decimal('market_price',10,2)->comment('市场价格');
            $table->decimal('shop_price',10,2)->comment('销售价');
            $table->text('goods_thumb')->comment('商品缩略图');
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
        Schema::dropIfExists('goods');
    }
}
