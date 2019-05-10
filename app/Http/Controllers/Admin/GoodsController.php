<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入Goods模型
use App\Admin\Goods;
class GoodsController extends Controller
{
    /**
     *  图书列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取所有图书信息
        $data = Goods::where('id','>','0')->orderby('id','desc')->paginate(5);
        return view('admin.goods.index',compact('data'));
    }

    /**
     * 新增图书页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.goods.create');
    }

    /**
     * 保存新增图书信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Goods $goods)
    {
        $goods['goods_sn']      = $request['goods_sn'];
        $goods['goods_name'] = $request['goods_name'];
        $goods['goods_nums']  =  $request['goods_nums'];
        $goods['market_price'] =  $request['market_price'];
        $goods['shop_price']     =   $request['shop_price'];
        $goods['goods_thumb'] = $request['goods_thumb'];
        $goods->save();
        return redirect('admin/goods');
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
        //获取当前的图书数据
        $goods = Goods::find($id);
        return view('admin.goods.edit',compact('goods'));
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
        // 获取当前修改的数据
        $goods = Goods::find($id);
        $goods['goods_sn']      = $request['goods_sn'];
        $goods['goods_name'] = $request['goods_name'];
        $goods['goods_nums']  =  $request['goods_nums'];
        $goods['market_price'] =  $request['market_price'];
        $goods['shop_price']     =   $request['shop_price'];
        $goods['goods_thumb'] = $request['goods_thumb'];
        $goods->save();
        return redirect('admin/goods');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $goods = Goods::where('id',$id)->delete();
        if($goods == '1'){
            return '1';
        }
        else {
            return '0';
        }
    }
}
