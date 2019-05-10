<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table -> increments('id') -> comment('会员ID');
            $table -> string('username',20) -> notNull() -> comment('会员用户名');
            $table -> string('passwd') -> notNull() -> comment('会员密码');
            $table -> enum('gender',[1,2,3]) -> notNull() ->default('1') -> comment('性别： 1=男 2=女 3=未知');
            $table -> string('mobile',11) -> comment('手机号');
            $table -> string('email',40) -> comment('邮箱地址');
            $table -> string('avatar') ->null()-> comment('头像地址');
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
        Schema::dropIfExists('member');
    }
}
