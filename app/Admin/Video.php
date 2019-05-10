<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
// 引入评论模型
use App\Admin\Comment;
class Video extends Model
{
   // 不可填充字段
   protected $guarded = [];
    //建立视频与评论的一对多关联(课程为主)
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
