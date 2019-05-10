<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入Manager模型
use App\Admin\Manager;
// 引入Input,获取用户输入
use Input;
// 引入角色模块
use App\Admin\Role;
// 引入DB门面类
use DB;

class ManagerController extends Controller
{
    //定义后台管理员列表显示
    public function index(Manager $manager){
        // 获取manager表的所有数据
        $data = Manager::all();
        // 获取所有用户数
        $counts = Manager::where('id','!=','')->count();
        // 将所有数据赋值给模板
        return view('admin.manager.index',compact('data','counts'));
    }

    // 检查用户名是否存在
    public function checkName(){
        $data = Input::except('_token');  // 排除csrf_token 的隐藏域值
        $checkName = DB::table('manager')->where('username',$data['username'])->get();
        $checkName = json_decode(json_encode($checkName), true);
        if(!empty($checkName)) return "false";
        else{
            return "true";
        }
    }

    // 检查手机号是否存在
    public function checkTel(){
        $data = Input::except('_token');  // 排除csrf_token 的隐藏域值
        $checkTel = DB::table('manager')->where('mobile',$data['mobile'])->get();
        $checkTel = json_decode(json_encode($checkTel), true);
        if(!empty($checkTel)) return "false";
        else{
            return "true";
        }
    }

    // 检查邮箱地址是否存在
    public function checkEmail(){
        $data = Input::except('_token');  // 排除csrf_token 的隐藏域值
        $checkEmail = DB::table('manager')->where('email',$data['email'])->get();
        $checkEmail = json_decode(json_encode($checkEmail), true);
        if(!empty($checkEmail)) return "false";
        else{
            return "true";
        }
    }

    // 添加管理员
    public function add(){
        //  如果提交过来的方法是post
        if(Input::method() == 'POST'){
          // 处理数据
          $data = Input::except('_token','repasswd','file');  // 排除csrf_token 的隐藏域值
          $data['password'] = bcrypt($data['password']);
          $data['created_at'] = date('Y-m-d H:i:s',time());

          $result = Manager::insert($data); // 将表单填写的数据进行入库
         // 由于框架本身不支持响应bool值,因此换种响应方式
          return $result ? '1' : '0';
        }
        else{
            $roles = Role::all();  // 获取所有的角色表的信息并赋值给模板
            // 获取用户数  
            return view('admin.manager.add',compact('roles'));
        }
    }

    // 编辑管理员
    public function edit(){
        // 判断方法是否为POST
        if(Input::method() == 'POST'){
            $data = Input::except('_token','repasswd','file');  // 排除csrf_token 的隐藏域值
            $data['updated_at'] = date('Y-m-d H:i:s',time());
            if(strlen($data['password']) > 25){
                $data['password'] = $data['password'];
            }
            else{
                $data['password'] =bcrypt($data['password']);
            }
            $manager = Manager::find($data['id']);
            $result = $manager -> update($data);
            return $result ? '1' : '0';
        }
        else{
            // 获取当前选中的id
            $id = Input::get('id');
            $data = DB::table('manager')->find($id); // 获取当前用户信息
            $roles = Role::all();  // 获取所有的角色表的信息并赋值给模板
            return view('admin.manager.edit',compact('data','roles'));
        }
    }

    // 删除管理员
    public function delete(){
        // 获取当前选中的id
        $id = Input::get('id');
        $result = Manager::destroy($id);   // 删除当前id的记录
        return $result ? '1' : '0';
    }

    // 展示管理员个人信息
    public function show(){
        return view('admin.manager.show');
    }
}
