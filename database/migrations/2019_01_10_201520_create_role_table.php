<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table -> increments('id') ->comment('角色ID');  //角色ID
            $table -> string('role_name',20)->notNull() ->comment('角色名称');  //角色名称
            $table -> text('auth_ids') ->comment('权限ID集合'); //权限ID集合
            $table -> text('auth_ac') ->comment('权限控制和方法集合');  //权限控制和方法集合
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
    }
}
