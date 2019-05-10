<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入Tag模型
use App\Admin\Tag;
// 引入TagRequest
use App\Http\Requests\TagRequest;
class TagController extends CommonController
{
    /**
     * 显示标签列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取Tag表的所有数据
         $data = Tag::where('id','>','0')->orderby('id','desc')->paginate(5);
        return view('admin.tag.index',compact('data'));
    }

    /**
     * 新增标签
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TagRequest $request)
    {
      
        return view('admin.tag.create');
    }

    /**
     * 保存添加的数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $model)
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
        ]);
        $model->create($request->all());
        return redirect('/admin/tag');
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
        // 查询当前id的记录
        $data = Tag::find($id);
        return view('admin.tag.edit',compact('data'));
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
        // 查询当前id的记录
        $data = Tag::find($id);
        // 将用户输入的数据进行修改
        $data['name'] = $request['name'];
        $data -> save();
        return redirect('/admin/tag');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //获取当前id的信息
        $result = Tag::destroy($id);
        return $result ? '1' : '0';
    }
}
