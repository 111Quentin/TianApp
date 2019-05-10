<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    //定义关联的数据表
    protected $table = 'role';
    //禁用时间戳
    public $timestamps = false;
    
    // 配置填充字段
     protected $fillable = ['role_name'];

    // 将分派的权限进行处理
    public function assignAuth($data){
        // 处理数据
        // 获取auth_ids字段的值
        $post['auth_ids'] = implode(',', $data['auth_id']); //1,2,3,4

        // 获取auth_ac
        $tmp = \App\Admin\Auth::where('pid','!=','0') -> whereIn('id',$data['auth_id']) -> get();

        // 循环拼凑controller和action
        $ac = '';
        foreach ($tmp as $key => $value) {
            $ac .= $value -> controller . '@' . $value -> action . ',';
        }

        // 除去末尾的逗号
        $post['auth_ac'] = strtolower(rtrim($ac,','));

        // 修改数据
        return self::where('id',$data['id']) -> update($post);
    }
}
