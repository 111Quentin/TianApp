<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Postfiles extends Model
{
    //指定数据表
    protected  $table ='postfiles';
    // 填充字段
    protected $fillable= ['post_id','files','created_at'];
}
