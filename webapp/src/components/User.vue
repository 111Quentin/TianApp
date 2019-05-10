<template>
        <div id="bg">
            <!--  页面顶部 -->
            <!--<div class="header ">-->
                <!--<mt-header  fixed title="个人中心" class="my_mint-header-title">-->
                <!--</mt-header>-->
            <!--</div>-->
            <!-- 页面顶部 -->

            <!-- 个人中心主体内容开始 -->
            <div class="usercenter">
            <!-- 头像 -->
            <div class="user">
                <!--<div class="code">-->
                    <!--<img src="static/images/qrcode.png" alt="" style="width: 2em;height: 1.8em;">-->
                <!--</div>-->
                <div class="userimg">
                    <img  :src="img" alt="用户头像">
                </div>
                <div class="username">
                    <span @click="redirect()">{{msg}}</span>
                </div>

            </div>


            <!-- 个人主页 -->
            <!--<div class="my">-->
            <!--<router-link to="/usercenter">-->
            <!--<i class="fa fa-user"></i>-->
            <!--<span>个人中心</span>-->
            <!--</router-link>-->
            <!--</div>-->

            <!-- 设置 -->
            <!--<div class="my setup">-->
            <!--<router-link to="/setting">-->
            <!--<i class="fa fa-cog"></i>-->
            <!--<span>系统设置</span>-->
            <!--</router-link>-->
            <!--</div>-->
        </div>

            <div class="usercount">
                <ul>
                    <li>
                        <a href="javascript:">
                            <h4>0</h4>
                            <span>关注</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:">
                            <h4>1</h4>
                            <span>粉丝</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="usericon">
                <ul class="mui-table-view mui-table-view-chevron">
                    <li class="mui-table-view-cell">
                        <a href="#notifications" class="mui-navigate-right" align="left"> <img src="static/images/blog.png" alt="" style="width: 28px;">&nbsp;&nbsp;我的帖子</a>
                    </li>
                    <li class="mui-table-view-cell">
                        <a href="#privacy" class="mui-navigate-right" align="left"><img src="static/images/shoucang.png" alt="" style="width: 28px;">&nbsp;&nbsp;我的收藏</a>
                    </li>
                </ul>
            </div>

            <div class="usericon">
                <ul class="mui-table-view mui-table-view-chevron">
                    <li class="mui-table-view-cell">
                        <router-link to="/usercenter" class="mui-navigate-right" align="left">
                            <img src="static/images/user.png" alt="" style="width: 28px;">&nbsp;&nbsp;个人中心
                        </router-link>
                    </li>
                    <li class="mui-table-view-cell">
                         <router-link to="/setting" class="mui-navigate-right" align="left">
                             <img src="static/images/setting.png" alt="" style="width: 28px;">&nbsp;&nbsp;设置
                         </router-link>
                    </li>
                </ul>
            </div>





            <!-- 个人中心主体内容结束 -->
            <!--底部固定导航-->
            <ul id="bottom">
                <li>
                    <!-- router-link最后是转化成a链接的-->
                    <router-link to="/">
                        <!--<i class="iconfont icon-shouye1"></i>-->
                        <i class="fa fa-home" style="font-size: 1.5em;color: #31343B;"></i>
                        <span>首页</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/video">
                        <!--<i class="iconfont icon-video"></i>-->
                        <i class="fa fa-film" style="font-size: 1.5em;color: #31343B;"></i>
                        <span>视频</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/myposts">
                        <!--<i class="iconfont icon-icon_message"></i>-->
                        <i class="fa fa-commenting-o" style="font-size: 1.5em;color: #31343B;"></i>
                        <span>下课聊</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/books">
                        <!--<i class="iconfont icon-icon_addresslist"></i>-->
                        <i class="fa fa-book" style="font-size: 1.5em;color: #31343B;"></i>
                        <span>书城</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/shopcart">
                    <span class="mui-icon mui-icon-extra">
					    <span class="mui-badge" id="badge">{{ $store.getters.getAllCount }}</span>
				   </span>
                        <!--<i class="iconfont icon-gouwuche"></i>-->
                        <i class="fa fa-shopping-cart" style="font-size: 1.5em;color: #31343B;"></i>
                        <span>购物车</span>
                    </router-link>
                </li>
                <li class="cur">
                    <router-link to="/user">
                        <!--<i class="iconfont icon-account"></i>-->
                        <i class="fa fa-user-o" style="font-size: 1.5em;color: #31343B;"></i>
                        <span>个人中心</span>
                    </router-link>
                </li>
            </ul>
            <!--底部固定导航结束-->
        </div>
</template>

<script>
    export default {
        name: 'User',
        data () {
            return {
                    msg: '点击登录',
                    loginStatus:false,  // 登录状态
                    img:'static/images/man.jpg'
                }
            },
        mounted(){
            let result =  JSON.parse(window.localStorage.getItem('userInfo'));
            if(result){
                this.loginStatus = true;  // 已登录
                this.msg = result.username;
                if(result.gender == '2'){
                     this.img = 'static/images/woman.png';
                }
            }else{
                this.loginStatus = false;  // 未登录
                this.msg = '点击登录';
            }
        },
        methods:{
            goBack() {
                // 点击后退
                this.$router.go(-1);
            },
            redirect(){
                 if(this.msg == '点击登录'){
                     this.$router.replace("/login");
                 }
                 else{
                     this.$router.replace("/usercenter");
                 }
            }
         }
        }
</script>


<style scoped>
  @import '../../static/css/user.css'
</style>
<style>
    .my_mint-header-title>h1{
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size: inherit;
        font-weight: 400;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        padding-bottom: 5px !important;
    }
    .my_mint-header-title .mint-button{
            padding-top: 4px !important;
            display: flex;
            justify-content: center;
            align-items: center;
    }
    .my_mint-header-title .mint-header-button{
            display: flex;
            justify-content: center;
            align-items: center;
    }
    .my_mint-header-title  .mint-button-text{
        margin-bottom: 0;
    }
    .mui-icon .mui-badge {
        font-size: 10px;
        line-height: 1.4;
        position: absolute;
        top: -2px;
        left: 79%;
        margin-left: -10px;
        padding: 1px 5px;
        color: #fff !important;
        background: red;
    }

    .mui-table-view {
        margin-top: 20px;
        position: relative;
        margin-top: 0;
        margin-bottom: 0;
        padding-left: 0;
        list-style: none;
        background-color: #fff;
    }

    .mui-table-view-chevron .mui-table-view-cell {
        padding-right: 65px;
    }

    .mui-table-view-cell {
        position: relative;
        overflow: hidden;
        padding: 11px 15px;
        -webkit-touch-callout: none;
    }
    .mui-table-view-chevron .mui-table-view-cell>a:not(.mui-btn) {
        margin-right: -65px;
    }
    .mui-table-view-cell>a:not(.mui-btn) {
        position: relative;
        display: block;
        overflow: hidden;
        margin: -11px -15px;
        padding: inherit;
        white-space: nowrap;
        text-overflow: ellipsis;
        color: inherit;
    }
</style>