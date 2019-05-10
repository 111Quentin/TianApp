<template>
    <div>
        <!--  页面顶部 -->
        <div class="header ">
            <mt-header  fixed title="个人中心" class="my_mint-header-title">
                   <span slot="left" @click="goBack">
                        <mt-button icon="back">返回</mt-button>
                   </span>
            </mt-header>
        </div>
        <!-- 页面顶部 -->

        <!-- 页面主体 -->
        <div class="content">
            <router-link to="/edituser">
            <mt-cell title="用户名" is-link>
                <span style="color: green">{{username}}</span>
            </mt-cell>
            <mt-cell title="更改密码" is-link>
                <!--<span style="color: green">Quentin</span>-->
            </mt-cell>
            <mt-cell title="性别" is-link>
                <span style="color: green">{{gender}}</span>
            </mt-cell>
            <mt-cell title="手机" is-link>
                <span style="color: green">{{mobile}}</span>
            </mt-cell>
            <mt-cell title="邮箱" is-link>
                <span style="color: green">{{email}}</span>
            </mt-cell>
            </router-link>
        </div>
        <!-- 页面主体 -->
    </div>
</template>

<script>
    import { Toast } from 'mint-ui';
    export default {
        name: 'Usercenter',
        data () {
            return {
                username:'',
                passwd:'',
                gender:'',
                mobile:'',
                email:'',
                loginStatus:false   // 登录状态
            }
        },
        mounted(){
              let userInfo = JSON.parse(window.localStorage.getItem('userInfo'));  // 将localStorage的值转换成对象
              if(userInfo){
                  this.username = userInfo.username;
                  this.mobile = userInfo.mobile;
                  // 判断性别
                  switch (userInfo.gender) {
                        case '1' :
                                this.gender = '男';
                                break;
                        case '2' :
                                this.gender = '女';
                                break;
                        default:
                                this.gender = '未知';
                                break;
                  }
                  this.email = userInfo.email;
                  this.username = userInfo.username;
              }
              else{
                  Toast({
                      message: '请先登录！',
                      iconClass: 'icon icon-error'
                  });
                  this.$router.replace("/login");
              }
        },
        methods:{
            goBack() {
                // 点击后退
                this.$router.go(-1);
            }
        }
    }
</script>


<style scoped>
    @import '../../static/css/usercenter.css'
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
</style>
