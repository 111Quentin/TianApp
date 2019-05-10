<?php
   /* 外部接口路由 */
   Route::group(['namespace' => 'Api'], function(){

       /*课程视频模块*/
       //显示标签
       Route::get('tags', 'ContentController@tags');
       //获取标签对应的课程
       Route::get('lesson/{tid}', 'ContentController@lesson');
       //获取推荐课程
       Route::get('commendLesson', 'ContentController@commendLesson');
       //获取热门课程
       Route::get('hotLesson', 'ContentController@hotLesson');
       //获取课程对应的视频列表
       Route::get('videos/{lessonId}', 'ContentController@videos');

       /*会员模块*/
       // 会员注册
       Route::post('member/register','ContentController@register');
       // 会员登录
       Route::post('member/login','ContentController@login');
       // 编辑会员
       Route::post('member/edit','ContentController@edit');
       // 会员评论
       Route::post('member/postcomment/{videoId}','ContentController@postcomment');
       // 获取会员评论信息
       Route::get('member/getcomments/{videoId}','ContentController@getcomments');

       /*文章模块*/
       // 上传动态
       Route::post('posts/{memberId}/create','PostController@create');
       // 上传图片到七牛云
       Route::post('posts/uploader/qiniu','PostController@qiniu');
       // 显示当前用户动态内容
       Route::get('posts/{memberId}/index','PostController@index');
       // 显示所有用户动态内容
       Route::get('posts/getall','PostController@getall');
       // 动态点赞
       Route::get('posts/{postsId}/{memberId}/zan','PostController@zan');
       // 动态取消点赞
       Route::get('posts/{postsId}/{memberId}/unzan','PostController@unzan');
       // 删除动态
       Route::get('posts/{postsId}/delete','PostController@delete');
       // 动态详情
       Route::get('posts/{postsId}/detail','PostController@detail');
       // 动态评论
       Route::post('posts/{postsId}/{memberId}/comments','PostController@comments');
       // 显示动态评论
       Route::get('posts/{postsId}/getComments','PostController@getComments');

       /* 书城模块 */

       // 获取所有的图书
       Route::get('books/getBooks','BooksController@getBooks');
       // 获取当前的图书信息
       Route::get('books/{bookId}/getBook','BooksController@getBook');
       // 获取购物车的图书数据
       Route::get('books/getShopcarlist/{bookIds}','BooksController@getShopcarlist');
   });