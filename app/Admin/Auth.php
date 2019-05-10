<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    //定义关联的数据表
    protected $table = 'auth';
    //禁用时间戳
    public $timestamps = false;
    // 填充字段
    protected $fillable = ['auth_name','controller','action','pid','is_nav'];
}
