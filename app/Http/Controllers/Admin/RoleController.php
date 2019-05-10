<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入Input门脸类
use Input;
// 引入Auth模型
use App\Admin\Auth;
// 引入Role模型
use App\Admin\Role;
// 引入DB类
use DB;
class RoleController extends Controller
{

    // 角色管理列表
    public function index()
    {
        // 获取所有数据
        $data = Role::get();
        // 展示视图
        return view('admin.role.index',compact('data'));
    }

    // 定义角色授权的方法
    public function assign()
    {
        // 判断请求类型
        if(Input::method() == 'POST'){
            // 接受数据
            $data = Input::only(['id','auth_id']);
            // 交给模型处理器
            $role = new Role();
            return $role -> assignAuth($data);
        }
        else{
            // 获取一级权限
            $top = Auth::where('pid','0') -> get();
            // 获取二级权限
            $cat = Auth::where('pid','!=','0') -> get();
            // 获取当前角色具备的权限id集合
            $ids = Role::where('id',Input::get('id')) -> value('auth_ids');
            // dd($ids);
            // 展示视图
            return view('admin.role.assign',compact('top','cat','ids'));
        }

    }

    // 定义添加角色的方法
    public function add(){
       //  如果提交过来的方法是post
       if(Input::method() == 'POST'){
          // 处理数据
          $data = Input::except('_token');  // 排除csrf_token 的隐藏域值
          $result = Role::insert($data); // 将表单填写的数据进行入库
         // 由于框架本身不支持响应bool值,因此换种响应方式
          return $result ? '1' : '0';
        }
        else{
            // 获取用户数  
            return view('admin.role.add');
        }
    }

    // 编辑管理员
    public function edit(){
        // 判断方法是否为POST
        if(Input::method() == 'POST'){
            $data = Input::only(['id','role_name']);
            $role = Role::find($data['id']);
            $result = $role -> update($data);
            return $result ? '1' : '0';
        }
        else{
            // 获取当前选中的id
            $id = Input::get('id');
            $data = DB::table('role')->find($id); // 获取当前用户信息
            return view('admin.role.edit',compact('data'));
        }
    }

    // 删除角色
    public function delete(){
        // 获取当前选中的id
        $id = Input::get('id');
        $result = Role::destroy($id);   // 删除当前id的记录
        return $result ? '1' : '0';
    }

}
