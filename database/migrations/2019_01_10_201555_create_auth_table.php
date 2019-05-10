<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth', function (Blueprint $table) {
            $table -> increments('id') -> comment('权限ID'); //权限ID
            $table -> string('auth_name',20) -> notNull() -> comment('权限名称');  //权限名称
            $table -> string('controller',40) -> notNull() -> comment('控制器名');
            $table -> string('action',30) -> notNull() -> comment('方法');
            $table -> tinyInteger('pid') -> comment('当前权限父级ID');
            $table -> enum('is_nav',[1,2]) -> notNull() -> default('1') -> comment('是否作为菜单显示');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth');
    }
}
