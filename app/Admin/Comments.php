<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = "comments";
    // 填充字段
    protected $fillable= ['posts_id','member_id','parent_id','content'];

    /**
     * 这条评论的所属用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(){
        return   $this->belongsTo(Member::class,'member_id','id');
    }

    /**
     * 一条评论可以嵌套多条评论
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(){
        return $this->hasMany(Comments::class,'parent_id','id');
    }
}
