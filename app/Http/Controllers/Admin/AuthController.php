<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;   //引入获取用户输入的门面类
use App\Admin\Auth;  //引入Auth模型
use DB;  //引入数据库模型
class AuthController extends Controller
{
    //权限管理列表
    public function index(){
       //查询数据
        //select t1.*,t2.auth_name as parent_name from auth as t1 left join auth as t2 on t1.pid = t2.id;
        $data = DB::table('auth as t1') -> select('t1.*','t2.auth_name as parent_name') -> leftJoin('auth as t2','t1.pid','=','t2.id') -> get();
        return view('admin.auth.index',compact('data'));
    }

    // 添加权限
    public function add(){
      // 判断请求类型
      if(Input::method() == 'POST'){
         // 处理数据
         // 如果需要验证数据可以仿照之前的规则去实现验证
         // 接受数据插入数据表
         $data = Input::except('_token');
         $result = Auth::insert($data);
         // 由于框架自身不支持响应bool值,所以转换另外一种形式
         return $result? '1' : '0';
      }
      else{
        // 查询父级权限
        $parents = Auth::where('pid','=','0')->get();
        // dd($parents);
        return view('admin.auth.add',compact('parents'));
      }
    }

    // 编辑权限
    public function edit(){
        // 判断方法是否为POST
        if(Input::method() == 'POST'){
          $data = Input::except('_token');
          $auth = Auth::find($data['id']);
          $result = $auth -> update($data);
          return $result ? '1' : '0';
      }
      else{
          // 获取当前选中的id
          $id = Input::get('id');
          $data = DB::table('auth')->find($id); // 获取当前用户信息
          $parents = Auth::where('pid','=','0')->get();
          return view('admin.auth.edit',compact('data','parents'));
      }
    }

    // 删除权限
    public function delete(){
        // 获取当前选中的id
        $id = Input::get('id');
        $result = Auth::destroy($id);   // 删除当前id的记录
        return $result ? '1' : '0';
    }
}
