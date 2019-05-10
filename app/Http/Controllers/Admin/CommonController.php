<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class CommonController
 *
 * @package App\Http\Controllers\Admin
 */
abstract class CommonController extends Controller
{
   
    /**
     * 成功信息
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($message)
    {
        return response()->json(['message' => $message, 'valid' => 1]);
    }

    /**
     * 错误信息
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($message)
    {
        return response()->json(['message' => $message, 'valid' => 0]);
    }

    /**
     * 将所有数据按祖孙格式整理
     * @param $data
     * @param int $parent_id
     * @param int $level
     * @return array
     */
    public  function getTree($data,$parent_id = 0,$level = 1){
        // 定义静态数组,保存每一次遍历到的数据
        static $list = array();
        foreach ($data  as  $value){
            foreach ($value as $v){
                if($v['parent_id'] == $parent_id) {
                    $v['level'] = $level;
                    $list[] = $v;
                    $this->getTree($data, $v['id'], $level + 1);
                }
            }
        }
        return $list;
    }
}
