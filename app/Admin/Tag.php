<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //定义关联的数据表
    protected $table = 'tags';

    // 定义黑名单
    protected $fillable = ['name'];

    // 声明标签与课程的多对多关联
    public function  lessons(){
          return $this->belongsToMany('App\Admin\Lesson');
    }
}
