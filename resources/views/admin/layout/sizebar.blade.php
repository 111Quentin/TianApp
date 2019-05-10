{{-- 侧边栏内容 --}}
<div id="sidebar" class="sidebar responsive ace-save-state">
                <script type="text/javascript">
                    try{ace.settings.loadState('sidebar')}catch(e){}
                </script>

                <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                        <button class="btn btn-success">
                            <i class="ace-icon fa fa-signal"></i>
                        </button>

                        <button class="btn btn-info">
                            <i class="ace-icon fa fa-pencil"></i>
                        </button>

                        <button class="btn btn-warning">
                            <i class="ace-icon fa fa-users"></i>
                        </button>

                        <button class="btn btn-danger">
                            <i class="ace-icon fa fa-cogs"></i>
                        </button>
                    </div>

                    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                        <span class="btn btn-success"></span>

                        <span class="btn btn-info"></span>

                        <span class="btn btn-warning"></span>

                        <span class="btn btn-danger"></span>
                    </div>
                </div>
                <!-- /.sidebar-shortcuts -->

                <ul class="nav nav-list">
                    
                    {{-- 主页 --}}
                    <li>
                        <a href="/admin/index/index">
                            <i class="menu-icon fa fa-tachometer"></i>
                            <span class="menu-text">主页</span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    {{-- 管理员管理 --}}
                    <li class="">
                        <a href="javascript:void(0)" class="dropdown-toggle">
                            <i class="menu-icon fa fa-user"></i>
                            <span class="menu-text">
                              管理员管理
                            </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="/admin/manager/index">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                     管理员列表
                                </a>
                            </li>
                            <li class="">
                                <a href="/admin/role/index">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                     角色管理
                                </a>
                            </li>

                            <li class="">
                                <a href="/admin/auth/index">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                     权限管理
                                </a>
                            </li>

                        </ul>
                    </li>

                    {{-- 会员管理 --}}
                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-user-md"></i>
                            <span class="menu-text"> 会员管理 </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="/admin/member">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    会员列表
                                </a>
                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    {{-- 评论管理 --}}
                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-comment"></i>
                            <span class="menu-text"> 评论管理 </span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="/admin/comment">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    评论列表
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    {{-- 动态管理 --}}
                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-file-o"></i>
                            <span class="menu-text"> 动态管理 </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="/admin/posts">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    动态列表
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="">
                                <a href="/admin/comments">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    评论列表
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>


                    {{-- 标签管理 --}}
                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-bookmark"></i>
                            <span class="menu-text"> 课程标签 </span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="/admin/tag">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    标签列表
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="">
                                <a href="/admin/tag/create">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    新增标签
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                     {{-- 课程管理 --}}
                     <li class="">
                            <a href="#" class="dropdown-toggle">
                                <i class="menu-icon fa fa-film"></i>
                                <span class="menu-text"> 课程管理 </span>
    
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
    
                            <b class="arrow"></b>
    
                            <ul class="submenu">
                                <li class="">
                                    <a href="/admin/lesson">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        课程列表
                                    </a>
    
                                    <b class="arrow"></b>
                                </li>
                                <li class="">
                                    <a href="/admin/lesson/create">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        新增课程
                                    </a>
    
                                    <b class="arrow"></b>
                                </li>
                            </ul>
                        </li>

                    {{-- 图书管理 --}}
                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-book"></i>
                            <span class="menu-text"> 图书管理 </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="/admin/goods">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    图书列表
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="">
                                <a href="/admin/goods/create">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    新增图书
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                </ul><!-- /.nav-list -->

                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>
            </div>

