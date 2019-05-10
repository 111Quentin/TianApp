<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->comment('主键ID');
            $table->text('content')->comment('文章内容');
            $table->text('files')->comment('文件路径');
            $table->integer('member_id')->comment('会员ID');
            $table -> enum('is_zan',[0,1]) -> notNull() ->default('0')->comment('是否点赞');//帐号状态，0=未点赞/取消点赞，1=点赞
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
        Schema::dropIfExists('posts');
    }
}
