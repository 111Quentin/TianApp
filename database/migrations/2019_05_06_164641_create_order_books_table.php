<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_books', function (Blueprint $table) {
            $table->increments('id')->comment('主键ID');
            $table->integer('order_id')->comment('订单ID');
            $table->integer('book_id')->comment('图书ID');
            $table->decimal('price',10,2)->comment('销售价格');
            $table->integer('books_count')->comment('图书数量');
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
        Schema::dropIfExists('order_books');
    }
}
