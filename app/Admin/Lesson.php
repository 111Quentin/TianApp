<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;


class Lesson extends Model
{

    // 不可填充字段
    protected $guarded = [];

    //建立课程与视频的一对多关联(课程为主)
    public function videos(){
        return $this->hasMany(Video::class);
    }

    // 建立课程与标签的多对多关联
     public function tags(){
         return $this->belongsToMany('App\Admin\Tag')->withTimestamps();
     }
}
