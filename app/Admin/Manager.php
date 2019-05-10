<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
//引入trait
use Illuminate\Auth\Authenticatable;
  class Manager extends Model  implements \Illuminate\Contracts\Auth\Authenticatable
{
   //定义当前关联的表名
   protected $table = 'manager';

   //不可以注入的字段
   protected $guarded=['remember_token'];  

   // 使用trait,相当于将整个trait代码复制过来(trait是php 5.4才有的语法,主要用于实现代码复用)
   use Authenticatable;

   // 定义用户关联角色的操作(一对一)
   public function role(){
      return $this->hasOne('App\Admin\Role','id','role_id');
   }
}
