<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // 指定与当前模块关联的数据表
    protected $table = 'comment';
    // 填充字段
    protected $fillable= ['content','video_id','member_id','member_name','created_at','updated_at'];
}
