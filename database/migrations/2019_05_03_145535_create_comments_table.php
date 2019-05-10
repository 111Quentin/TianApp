<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id')->comment('主键ID');
            $table->integer('posts_id')->index()->comment('文章ID');
            $table->integer('member_id')->index()->comment('会员ID');
            $table->integer('parent_id')->index()->nullable()->comment('父级评论ID');
            $table->integer('level')->default('1')->comment('评论层级');  // 当评论层级超过三不再缩进
            $table->text('content')->comment('评论内容');
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
        Schema::dropIfExists('comments');
    }
}
