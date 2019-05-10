<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// 引入Comment模型
use App\Admin\Comment;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * 评论列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取所有的会员评论信息
        $data = Comment::where('id','>','0')->orderby('id','desc')->paginate(5);
        return view('admin.comment.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除评论
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 删除评论数据
        $comment = Comment::destroy($id);
        if($comment == '1'){
            return '1';
        }
        else {
            return '0';
        }
    }
}
