<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入Member模型
use App\Admin\Member;
class MemberController extends Controller
{
    /**
     *  会员列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //查询数据
        $data = Member::get(); //获取所有数据
        // 获取所有用户数
        $counts = Member::where('id','!=','')->count();
        return view('admin.member.index',compact('data','counts'));  //将数据赋值给视图并显示视图
    }

    /**
     * 会员添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $member = Member::get();   // 获取所有的会员数据
        return view('admin.member.create',compact('member'));
    }

    /**
     *  保存添加会员的数据
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Member $member)
    {
//        $this->validate($request, [
//            // 防止用户名重名
//            'username' => 'required|unique:member,username',
//            // 一个手机号只能注册一个会员
//            'mobile' => 'required|unique:member,mobile',
//        ]);
        // 将用户填写的信息添加到member表中
        $member['username'] = $request['username'];
        $member['passwd'] = md5($request['passwd']);
        $member['gender'] = $request['gender'];
        $member['mobile'] = $request['mobile'];
        $member['email'] = $request['email'];
        $member['avatar'] = $request['avatar'];
        $member['created_at'] = date('Y-m-d H:i:s',time());
        // 保存数据
        $result = $member->save();
        echo $result ? '1' : '0';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 编辑会员
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 获取当前id会员的信息
        $member =  Member::find($id);
         return view('admin.member.edit',compact('member'));
    }

    /**
     *  保存会员更改的数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 获取当前会员id的数据
        $member = Member::find($id);
        // 将用户更改的数据保存到数据表
        $member['username'] = $request['username'];
        $member['passwd'] = bcrypt($request['passwd']);
        $member['gender'] = $request['gender'];
        $member['mobile'] = $request['mobile'];
        $member['email'] = $request['email'];
        $member['avatar'] = $request['avatar'];
        $member['updated_at'] =  date('Y-m-d H:i:s',time());
        $result = $member->save();
        echo $result ? '1' : '0';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除当前会员
        $result = Member::destroy($id);
        if($result == '1'){
            return '1';
        }
        else {
            return '0';
        }
    }
}
