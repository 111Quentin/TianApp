<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //指定数据表
    protected  $table ='posts';
    // 填充字段
    protected $fillable = ['content','files','member_id','is_zan','created_at'];

    /**
     * 与会员建立多对一关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member(){
        return $this->belongsTo(Member::class,'member_id','id');
    }

    /**
     *点赞
     */
    public function zans(){
        return  $this->hasMany(Zans::class)->orderBy('created_at','desc');
    }

    /**
     * 判断一个用户是否为动态点过赞
     * @param $member_id
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zan($member_id){
        return $this->hasOne(Zans::class)->where('member_id',$member_id);
    }

    /**
     * 一条动态可以有多条评论
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(){
         return $this->hasMany(Comments::class);
    }

    /**
     * 获取评论数据以及评论所有者数据
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getComments(){
           return $this->comments()->with('owner')->get()->groupby('parent_id');
    }
}
