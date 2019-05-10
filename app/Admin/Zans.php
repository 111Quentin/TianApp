<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Zans extends Model
{
    // 指定数据表
    protected  $table = 'zans';
    // 填充字段
    protected $fillable= ['member_id','posts_id','created_at'];
}
