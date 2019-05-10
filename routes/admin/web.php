<?php
// 后台路由部分
Route::group(['prefix' => 'admin','namespace' => 'Admin'],function(){
    // 后台登录界面
    Route::get('public/login','PublicController@login') -> name('login');   //进行路由命名,因为auth中间件官方固定调到login路由上
    // 后台登录处理页面
    Route::post('public/check','PublicController@check');
    // 后台退出登录
    Route::get('public/logout','PublicController@logout');
});


// 后台路由部分(需要权限判断)
Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth:admin','checkrbac']],function(){
    // 后台首页路由
    Route::get('index/index','IndexController@index');//使用中间件进行路由保护,只有通过验证才能访问到该路由,一般来说,处理除了登录页面不需要路由保护,其他后台页面都需要

     /*管理员模块*/
    // 管理员列表
    Route::get('manager/index','ManagerController@index');
    // 检查用户名是否存在
    Route::any('manager/checkname','ManagerController@checkName');
    // 检查手机号是否存在
    Route::any('manager/checktel','ManagerController@checkTel');
    // 检查邮箱是否存在
    Route::any('manager/checkemail','ManagerController@checkEmail');

    // 管理员添加
    Route::any('manager/add','ManagerController@add');
    // 管理员编辑
    Route::any('manager/edit','ManagerController@edit');
    // 管理员删除
    Route::get('manager/delete','ManagerController@delete');
    // 展示管理员信息
    Route::get('manager/show','ManagerController@show');

    /*权限管理模块*/
    // 权限列表
    Route::get('auth/index','AuthController@index');
    // 权限添加
    Route::any('auth/add','AuthController@add');
    // 权限编辑
    Route::any('auth/edit','AuthController@edit');
    // 权限删除
    Route::get('auth/delete','AuthController@delete');

    /*角色管理模块*/
    // 角色列表
    Route::get('role/index','RoleController@index');
    // 角色授权
    Route::any('role/assign','RoleController@assign');
    // 角色添加
    Route::any('role/add','RoleController@add');
    // 角色编辑
    Route::any('role/edit','RoleController@edit');
    // 角色删除
    Route::get('role/delete','RoleController@delete');

    /*会员管理模块*/
    Route::resource('member','MemberController');
    // 标签内容模块
    Route::resource('tag','TagController');
    // 课程管理模块
    Route::resource('lesson','LessonController');
    // 评论管理模块
    Route::resource('comment','CommentController');

    // 上传模块
    Route::post('uploader/webuploader','UploaderController@webuploader'); //异步上传
    Route::post('uploader/qiniu','UploaderController@qiniu');  // 七牛上传

    // 获取doughnut数据
    Route::get('getChartData','IndexController@getChartData');
    // 获取折线图数据
    Route::get('getLineChartData','IndexController@getLineChartData');

    /* 动态管理模块 */
    Route::resource('posts','PostsController');

    /* 动态评论模块 */
    Route::resource('comments','CommentsController');

    /* 图书管理模块 */
    Route::resource('goods','GoodsController');
});

