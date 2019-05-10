<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入图书模块
use App\Admin\Goods;
class BooksController extends CommonController
{

    /**
     * 获取所有的图书信息
     * @param Request $request
     * @return array
     */
    public function getBooks(Request $request){
        $pageSize = 6;
        if($request['pageIndex']){
            $limitprame =  ($request['pageIndex'] - 1) * $pageSize;
        }
        else $limitprame = 0;
      $books = Goods::where('id','>',0)->skip($limitprame)->limit($pageSize)->orderby('created_at','desc')->get();
       if($books){
           return $this->response($books);
       }
       return $this->response('暂无图书信息','500');
    }

    /**
     * 获取当前的图书信息
     * @param $bookId
     * @param Request $request
     * @return array
     */
    public function  getBook($bookId,Request $request){
        $book = Goods::find(['id' => $bookId]);
        if ($book){
            return $this->response($book);
        }
        return $this->response('获取动态数据失败！','500');
    }

    /**
     * 获取购物车的数据
     * @param $bookIds
     * @param Request $request
     * @return array
     */
    public function getShopcarlist($bookIds,Request $request){
        $bookIds = explode(',',$bookIds);
        $booksList = [];
        if($bookIds != []){
            foreach ($bookIds as $value){
                $booksList[$value] = Goods::find($value)->toArray();
            }
        }
        if($booksList){
            return $this->response($booksList);
        }
        else return $this->response('获取购物车数据失败','500');
    }
}
