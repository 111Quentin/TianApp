<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Admin\Member;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //显示后台首页
    public function index(){
        $version = PHP_VERSION;
        $lessons = DB::table('lessons')->count();
        $members = DB::table('member')->count();
        $comments = DB::table('comment')->count();
        return view('admin.index.index',compact('version','lessons','members','comments'));
    }

    /**
     *  获取各标签下课程数据
     */
    public function getChartData(){
        // 获取PHP标签下的课程数
        $nums = array();
        $nums[0] = DB::table('lesson_tag')->where('tag_id',1)->count();
        $nums[1] = DB::table('lesson_tag')->where('tag_id',2)->count();
        $nums[2] = DB::table('lesson_tag')->where('tag_id',3)->count();
        $nums[3] = DB::table('lesson_tag')->where('tag_id',4)->count();
        $nums[4]= DB::table('lesson_tag')->where('tag_id',5)->count();
        return $nums;
    }

    public function getLineChartData(){
        // 存取近七天注册会员注册人数
        $data = array();
        // 存取近七天日期
        $label = array();

        // 前第6天注册人数
        $presix_start= strtotime(date("Y-m-d",strtotime("-6 day")));
        $presix_end = $presix_start+24 * 60 * 60-1;  //昨天结束时间
        $presixDay = array(date("Y-m-d H:i:s",$presix_start),date("Y-m-d H:i:s",$presix_end));
        $data['presixDay'] = Member::whereBetween('created_at',$presixDay)->count();
        $label['presixDay'] = date("Y-m-d",$presix_start);
        // 前第5天注册人数
        $prefive_start= strtotime(date("Y-m-d",strtotime("-5 day")));
        $prefive_end = $prefive_start+24 * 60 * 60-1;  //昨天结束时间
        $prefiveDay = array(date("Y-m-d H:i:s",$prefive_start),date("Y-m-d H:i:s",$prefive_end));
        $data['prefiveDay'] = Member::whereBetween('created_at',$prefiveDay)->count();
        $label['prefiveDay'] = date("Y-m-d",$prefive_start);
        // 前第4天注册人数
        $prefour_start= strtotime(date("Y-m-d",strtotime("-4 day")));
        $prefour_end = $prefour_start+24 * 60 * 60-1;  //昨天结束时间
        $prefourDay = array(date("Y-m-d H:i:s",$prefour_start),date("Y-m-d H:i:s",$prefour_end));
        $data['prefourDay'] = Member::whereBetween('created_at',$prefourDay)->count();
        $label['prefourDay'] = date("Y-m-d",$prefour_start);
        // 前第3天注册人数
        $prethree_start= strtotime(date("Y-m-d",strtotime("-3 day")));
        $prethree_end = $prethree_start+24 * 60 * 60-1;  //昨天结束时间
        $prethreeDay = array(date("Y-m-d H:i:s",$prethree_start),date("Y-m-d H:i:s",$prethree_end));
        $data['prethreeDay'] = Member::whereBetween('created_at',$prethreeDay)->count();
        $label['prethreeDay'] = date("Y-m-d",$prethree_start);
        // 前第2天注册人数
        $pretwo_start= strtotime(date("Y-m-d",strtotime("-2 day")));
        $pretwo_end = $pretwo_start+24 * 60 * 60-1;  //昨天结束时间
        $pretwoDay = array(date("Y-m-d H:i:s",$pretwo_start),date("Y-m-d H:i:s",$pretwo_end));
        $data['pretwoDay'] = Member::whereBetween('created_at',$pretwoDay)->count();
        $label['pretwoDay'] = date("Y-m-d",$pretwo_start);
        // 前第1天注册人数
        $preone_start= strtotime(date("Y-m-d",strtotime("-1 day")));
        $preone_end = $preone_start+24 * 60 * 60-1;  //昨天结束时间
        $preoneDay = array(date("Y-m-d H:i:s",$preone_start),date("Y-m-d H:i:s",$preone_end));
        $data['preoneDay'] = Member::whereBetween('created_at',$preoneDay)->count();
        $label['preoneDay'] = date("Y-m-d",$preone_start);
        // 今天注册人数
        $today_start= strtotime(date("Y-m-d",strtotime("0 day")));
        $today_end = $today_start+24 * 60 * 60-1;  //昨天结束时间
        $today= array(date("Y-m-d H:i:s",$today_start),date("Y-m-d H:i:s",$today_end));
        $data['today'] = Member::whereBetween('created_at',$today)->count();
        $label['today'] = date("Y-m-d",$today_start);
        return compact('data','label');
    }
}
