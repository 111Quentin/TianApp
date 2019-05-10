<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入Tag模型
use  App\Admin\Tag;
//引入Lesson模型
use App\Admin\Lesson;
// 引入Video模型
use App\Admin\Video;
// 引入DB门脸类
use DB;
// 引入member模型
use App\Admin\Member;
// 引入Auth门脸类
use Auth;
// 获取用户输入
use Input;
// 引入Comment模型
use App\Admin\Comment;

class ContentController extends CommonController
{

    /**
     * 获取标签列表
     *
     * @return array
     */
    public function tags()
    {
        $data = Tag::get();
        if($data){
            return $this->response($data);
        }
        return $this->response('没有类别信息',404);

    }

    /**
     * 获取课程列表
     *
     * @param $tid
     *@param Request $request
     *
     * @return array
     */
    public function lesson($tid,Request $request)
    {
        if ($tid) {
            $data = DB::table('lessons')
                ->select('lessons.*')
                ->join('lesson_tag', 'lessons.id', '=', 'lesson_tag.lesson_id')
                ->where('tag_id', $tid)
                ->orderby('created_at','desc')
                ->get();
        } else {
            $pageSize = 8;
            if($request['pageIndex']){
                $limitprame =  ($request['pageIndex'] - 1) * $pageSize;
            }
            else $limitprame = 0;
            $data = Lesson::where('id','>',0)->orderby('created_at','desc')->get();
        }

        return $this->response($data);
    }

    /**
     * 获取推荐课程
     *
     *   @param Request $request
     *
     * @return array
     */
    public function commendLesson(Request $request)
    {
        $pageSize = 4;
        if($request['pageIndex']){
            $limitprame =  ($request['pageIndex'] - 1) * $pageSize;
        }
        else $limitprame = 0;
        $data = Lesson::where('iscommend', 1)->skip($limitprame)->limit($pageSize)->orderby('created_at','desc')->get();
        if($data){
            return $this->response($data);
        }
        return $this->response('暂无推荐视频消息','404');
    }

    /**
     * 获取热门课程
     *
     *   @param Request $request
     *
     * @return array
     */
    public function hotLesson(Request $request)
    {
        $pageSize = 4;
        if($request['pageIndex']){
            $limitprame =  ($request['pageIndex'] - 1) * $pageSize;
        }
        else $limitprame = 0;
        $data = Lesson::where('ishot', 1)->skip($limitprame)->limit($pageSize)->orderby('created_at','desc')->get();
        if($data){
            return $this->response($data);
        }
        return $this->response('暂无热门视频消息','404');
    }

    /**
     * 获取视频列表
     *
     * @param $lessonId
     *
     * @return array
     */
    public function videos($lessonId)
    {
        $data = Video::where('lesson_id', $lessonId)->orderby('created_at','desc')->get();
        return $this->response($data);
    }

    /**
     * 会员注册
     * @param Request $request
     * @return array
     */
   public function  register(Request $request){
            // 获取会员输入的所有数据
           $data['username'] = $request['username'];
           $data['passwd'] = md5($request['passwd']);
           $data['gender'] = $request['gender'];
           $data['mobile'] = $request['mobile'];
           $data['email'] = $request['email'];
           $data['avatar'] = $request['avatar'];
           $data['created_at'] = date('Y-m-d H:i:s',time());
           //  将数据写入数据表
           $result =  Member::create($data);
           if($result){
               return $this->response($data);
           }
          return $this->response('注册失败！','500');

   }

    /**
     * 会员登录
     * @param Request $request
     * @return array
     */
     public function login(Request $request){
           // 获取输入的手机号和密码
           $data['mobile']  = $request['mobile'];
           $data['passwd'] = md5($request['passwd']);
           $result = DB::table('member')->where('mobile',$data['mobile'])->where('passwd',$data['passwd'])->first();
           if($result){
               $member = json_decode(json_encode($result), true);
               $data = $member;
               return $this->response($data);
           }
           return $this->response('登录失败！','404');
     }

    /**
     * 编辑会员
     * @return array
     */
     public function  edit(){
          // 获取用户输入的数据
          $data = Input::all();
          // 判断是用户输入的密码还是MD5生成的密码
         if(strlen($data['passwd']) > 25){
             $data['passwd'] = $data['passwd'];
         }
         else{
             $data['passwd'] = md5($data['passwd']);
         }
         $data['updated_at'] = date('Y-m-d H:i:s',time());
         $member = Member::find($data['id']);
         $result = $member -> update($data);
         if($result){
             return $this->response($data);
         }
         return $this->response('编辑失败！','500');
     }

    /**
     * 提交当前视频的评论
     * @param $videoId
     * @param Request $request
     * @return array
     */

     public function postcomment($videoId,Request $request){
         // 获取用户输入的数据
          $data['content'] = $request['content'];
          $data['member_id'] = $request['member_id'];
          $data['member_name'] = $request['member_name'];
          $data['video_id'] = $videoId;
          $data['created_at'] = date('Y-m-d H:i:s',time());

         //  将数据写入数据表
         $result = Comment::create($data);
        if($result){
            return $this->response($data);
        }
         return $this->response('评论失败！','500');
     }

    /**
     * 获取当前视频的所有评论
     * @param $videoId
     * @param Request $request
     * @return array
     */
       public function  getcomments($videoId,Request $request){

           $pageSize = 5;
            if($request['pageIndex']){
                $limitprame =  ($request['pageIndex'] - 1) * $pageSize;
            }
            else $limitprame = 0;
            $data =  Comment::where('video_id',$videoId)->skip($limitprame)->limit($pageSize)->get();
            if($data){
                return $this->response($data);
            }
           return $this->response('暂未评论！','404');
       }
}
