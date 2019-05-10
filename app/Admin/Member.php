<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//引入trait
use Illuminate\Auth\Authenticatable;
// 引入评论模型
use App\Admin\Comment;
class Member extends Model   implements \Illuminate\Contracts\Auth\Authenticatable
{
    // 指定与当前模块关联的数据表
    protected $table = 'member';
    // 填充字段
    protected $fillable= ['username','passwd','gender','mobile','email','avatar','created_at'];
    // 使用trait,相当于将整个trait代码复制过来(trait是php 5.4才有的语法,主要用于实现代码复用)
    use Authenticatable;

    //不可以注入的字段
    protected $guarded=['remember_token'];

    //建立会员与评论的一对多关联(课程为主)
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
