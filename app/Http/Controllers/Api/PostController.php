<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入DB门脸类
use DB;
// 引入member模型
use App\Admin\Member;
// 引入文章模型
use  App\Admin\Posts;
// 引入文章文件模型
use  App\Admin\Postfiles;
// 引入点赞模块
use App\Admin\Zans;
// 引入评论模型
use App\Admin\Comments;
//引入storage
use Storage;
class PostController extends CommonController
{
    /**
     *  上传文章
     * @param $memberId
     * @param Request $request
     * @return array
     */
    public function  create($memberId,Request $request){
        // 获取用户数据
        $data['content'] = $request['content'];
        $data['member_id'] = $memberId;
        $data['created_at'] = date('Y-m-d H:i:s',time());
        $result1 =Posts::create($data);
        $result2 = '';
        foreach ($request['files'] as $file){
            $data2['post_id'] = $result1['id'];
            $data2['files'] = $file;
            $result2 = Postfiles::create($data2);
        }
        if($result1 &&  $result2){
            return $this->response($data);
        }
        return $this->response('上传动态失败！','500');
    }

    /**
     * 上传图片到七牛云
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function qiniu(Request $request){
        //判断是否有文件上传成功
        if($request -> hasFile('file') && $request -> file('file') -> isValid()){
            //有文件上传（重点）
            $filename = sha1(time() . $request -> file('file') -> getClientOriginalName()) . '.' .  $request -> file('file') -> getClientOriginalExtension();
            //文件保存/移动
            Storage::disk('qiniu') -> put($filename, file_get_contents($request -> file('file') -> path()));
            //返回数据
            $result = [
                'errCode'       =>      '0',
                'errMsg'        =>      '',
                'succMsg'       =>      '文件上传成功！',
                'path'          =>      Storage::disk('qiniu') -> getDriver() -> downloadUrl($filename)
            ];
        }else{
            //没有文件被上传或者出错
            $result = [
                'errCode'       =>      '000001',
                'errMsg'        =>      $request -> file('file') -> getErrorMessage()
            ];
        }
        //返回信息
        return response() -> json($result);
    }

    /**
     *   获取当前用户动态
     * @param $memberId
     * @param Request $request
     * @return array
     */
    public  function  index($memberId,Request $request){
        $postLists = Posts::where('member_id',$memberId)->orderby('created_at','desc')->get();
        // 将集合转换成数组
        $postLists = json_decode(json_encode($postLists), true);
        // 遍历每条动态的上传文件
        foreach ($postLists as $key => $value){
            $files = Postfiles::where('post_id',$value['id'])->get();
            $files = json_decode(json_encode($files), true);
            $value['files'] = '';
                  foreach ($files as $k => $v){
                      $value['files'] .=$v['files'].'&';
                  }
            $result = Posts::where('id',$value['id'])->update(['files' => $value['files']]);
        }
        if($postLists){
            return $this->response($postLists);
        }
        return $this->response('获取动态数据失败！','500');
    }

    /**
     *   获取所有用户动态
     * @param Request $request
     * @return array
     */
    public  function  getall(Request $request){
        $postLists = Posts::where('member_id','>',0)->with('member')->orderby('created_at','desc')->get()->toArray();
        // 遍历每条动态的上传文件
        foreach ($postLists as $key => $value){
            $files = Postfiles::where('post_id',$value['id'])->get()->toArray();
            $member = Member::where('id',$value['member_id'])->get()->toArray();
            $value['files'] = '';
            foreach ($files as $k => $v){
                $value['files'] .=$v['files'].'&';
            }
            $result = Posts::where('id',$value['id'])->update(['files' => $value['files']]);
        }
        if($postLists){
            return $this->response($postLists);
        }
        return $this->response('获取所有人的动态数据失败！','500');
    }

    /**
     * 点赞
     * @param $postsId
     * @param $memberId
     * @return array
     */

    public function  zan($postsId,$memberId){
            $data['posts_id'] = intval($postsId);
            $data['member_id'] = intval($memberId);
            // 先判断用户是否为该文章点过赞（只能点赞一次）
            $exists =  Zans::where(['posts_id' => intval($postsId),'member_id' => intval($memberId)])->get();
            $exists = json_decode(json_encode($exists), true);
            if($exists != [])     return   $this->response('已点赞','501');
            $result = Zans::create($data);
            if($result){
                // 说明点赞成功，给posts表的is_zan置为1
                Posts::where('id',$data['posts_id'])->update(['is_zan' => '1']);
                return $this->response('点赞成功！');
            }
            return   $this->response('点赞失败！','500');
    }

    /**
     * 取消点赞
     * @param $postsId
     * @param $memberId
     * @return array
     */
    public function unzan($postsId,$memberId){
            // 先查询是否点赞(为点赞不能取消点赞)
            $exists =  Zans::where(['posts_id' => intval($postsId),'member_id' => intval($memberId)])->get();
            $exists = json_decode(json_encode($exists), true);
            if($exists == [])  return $this->response('未点赞','501');
            $result =  Zans::where(['posts_id' => $postsId,'member_id' => $memberId])->delete();
            if($result){
                // 说明取消点赞成功，给posts表的is_zan置为1
                Posts::where('id',$postsId)->update(['is_zan' => '0']);
                return $this->response('取消点赞成功！');
            }
            return   $this->response('取消点赞失败！','500');
    }

    /**
     * 删除动态
     * @param $postId
     * @return array
     */
    public function  delete($postId){
            $result =  Posts::where('id',$postId)->delete();
            $result1 =  Postfiles::where('post_id',$postId)->delete();
            if($result && $result1){
                return $this->response('删除动态成功！');
            }
            return   $this->response('删除动态失败','500');
    }

    /**
     * 动态详情
     * @param $postId
     * @return array
     */
    public function detail($postId){
        $result = Posts::find(['id' => $postId]);
        $result = json_decode(json_encode($result), true);
        if ($result){
            return $this->response($result);
        }
        return $this->response('获取动态数据失败！','500');
    }

    /**
     * 动态评论
     * @param $postId
     * @param $memberId
     * @param Request $request
     * @return array
     */
    public function comments($postId,$memberId,Request $request){
            $data['posts_id'] = intval($postId);
            $data['member_id'] = intval($memberId);
            $data['content'] = trim($request['content']);
            $data['parent_id'] = intval($request['parent_id']);
            $result = Comments::create($data);
            if($result){
                return $this->response('评论成功！');
            }
            return $this->reponse('评论失败','500');
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

    /**
     * 获取当前评论下的所有评论以及所有评论下的子评论
     * @param $postId
     * @param Posts $posts
     * @return array
     */
    public function  getComments($postId,Posts $posts){
        // 预加载评论模型的owner方法
        $posts->load('comments.owner'); // select * from `posts`;
        // 拿到所有的评论数据
        $comments = $posts->find($postId)->getComments()->toArray();
        // 再调用无限级(祖寻孙)的方法
        $data = $this->getTree($comments);
        // 获取当前动态总评论数
        $data['allcount'] = Comments::where('posts_id',$postId)->count();
        if($data){
            return  $this->response($data);
        }
            return $this->response('获取评论数据失败','500');
    }
}
