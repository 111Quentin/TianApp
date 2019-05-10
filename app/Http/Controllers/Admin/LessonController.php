<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入Lesson模型
use App\Admin\Lesson;
// 引入Video模型
use App\Admin\Video;
// 引入Tag模型
use App\Admin\Tag;
// 引入DB门脸类
use DB;
class LessonController extends Controller
{
    /**
     * 课程列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取所有的课程的信息
        $data = Lesson::where('id','>','0')->orderby('id','desc')->paginate(5);
        return view('admin.lesson.index',compact('data'));
    }

    /**
     * 新增课程页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::get();   // 获取所有的标签数据
        return view('admin.lesson.create',compact('tags'));
    }

    /**
     * 保存新增课程内容
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Lesson $lesson)
    {
        // 将用户输入的信息填充到lesson表里面去
        $lesson['title']     = $request['title'];
        $lesson['introduce'] = $request['introduce'];
        $lesson['preview']   = $request['preview'];
        $lesson['iscommend'] = $request['iscommend'];
        $lesson['ishot']     = $request['ishot'];
        $lesson['click']     = $request['click'];
        $lesson->save();

       // 将上传视频的json数据转换成数组
        $videos = json_decode($request['videos'], true);
        foreach ($videos as $video) {
            $lesson->videos()->create([
                'title' => $video['title'],
                'path'  => $video['path'],
            ]);
        }

        // 将标签数据写到中间表
        $lesson->tags()->attach($request->input('tag_list'));
        return redirect('admin/lesson');
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
     * 显示编辑课程页面和编辑数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 获取所有的标签数据
        $tags =  Tag::get();
        $tag_ids = DB::table('lesson_tag')->where('lesson_id',$id)->select('tag_id')->get();
        $tag_ids= json_decode(json_encode($tag_ids), true);

         foreach ($tag_ids as $val)
         {
             $tag_id[] = implode(',',$val);
         }

         // 根据tag_id集合使用mysql的in语法查询符合条件的记录(获取到的是一个集合,需要转换成数组)
        $taglists = DB::table('tags')->wherein('id',$tag_id)->select('id')->get();
         // 将集合转换成数组
        $taglists =  json_decode(json_encode($taglists),true);
        // 遍历二维数组
         foreach ($taglists as $v){

             $taglist[] = implode(',',$v);
         }

        // 获取当前id的数据
        $lesson =  Lesson::find($id);
        // 获取当前lesson_id下的所有video数据
        $videos = json_encode($lesson->videos()->get()->toArray(),JSON_UNESCAPED_UNICODE);
        // 将变量赋值给模板
        return view('admin.lesson.edit',compact('lesson','videos','tags','taglist'));
    }

    /**
     * 更新编辑课程内容数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            // 获取当前课程id的数据
            $lesson              = Lesson::find($id);
            $lesson['title']     = $request['title'];
            $lesson['introduce'] = $request['introduce'];
            $lesson['preview']   = $request['preview'];
            $lesson['iscommend'] = $request['iscommend'];
            $lesson['ishot']     = $request['ishot'];
            $lesson['click']     = $request['click'];
            $lesson->save();  // 更新数据到数据表

            // 清空当前lesson_id下的所有视频
            Video::where('lesson_id',$id)->delete();
            // 清空当前lesson_id下的所有数据
            DB::table('lesson_tag')->where('lesson_id',$id)->delete();

            // 将修改的数据写入数据表
            $lesson->tags()->attach($request['tag_list']);
            // 将前端传递过来的json数据转换为数组
             $videos =   json_decode($request['videos'],true);
             // 遍历数组,将数据添加到数据表
            foreach ($videos as $video){
                  $lesson->videos()->create([
                       'title'  => $video['title'],
                      'path' => $video['path'],
                  ]);
            }
            // 重定向到课程列表
            return redirect('/admin/lesson');
    }

    /**
     * 删除课程视频
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 删除课程数据
        $lesson = Lesson::destroy($id);
         // 删除视频数据
        $videos = Video::where('lesson_id',$id)->delete();
        if($lesson == '1'){
             return '1';
        }
        else {
            return '0';
        }
    }

}
