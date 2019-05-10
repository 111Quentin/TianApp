<template>
    <div>
        <!--  页面顶部 -->
        <div class="header ">
            <mt-header  fixed title="登录界面" class="my_mint-header-title">
                   <span slot="left" @click="goBack">
                        <mt-button icon="back">返回</mt-button>
                   </span>
            </mt-header>
        </div>
        <!-- 页面顶部 -->

        <!-- 页面主体 -->
        <div class="content">
                <mt-field label="手机号" placeholder="请输入手机号" v-model="mobile"></mt-field>
                <mt-field label="密码" placeholder="请输入密码" type="password" v-model="passwd"></mt-field>
                <div class="login">
                    <mt-button size="large" type="primary" @click="login">登录</mt-button>
                    <router-link to="/register">
                        <span>注册</span>
                    </router-link>
                </div>
        </div>
        <!-- 页面主体 -->
    </div>
</template>

<script>
    import  { requestLogin } from "../api/api";
    import { Toast } from 'mint-ui';
    export default {
        name: 'Login',
        data () {
            return {
                mobile:'',
                passwd:'',
                loginStatus:false   // 登录状态
            }
        },
        methods:{
            goBack() {
                // 点击后退
                this.$router.go(-1);
            },
            // 登录方法
            login(){
                  // 手机号和密码是否为空
                   if(!this.mobile || !this.passwd){
                         Toast({
                             message: '请填写完整',
                             iconClass: 'icon icon-error',
                             position: 'top',
                         });
                       return;  // 跳出if条件
                   }
                   // 将数据储存到data
                   let data = {
                         mobile:this.mobile,
                        passwd:this.passwd
                   };

                //TODO: 设置loading状态
                this.$store.commit('showLoading')

                // 把data作为params传入登录接口
                requestLogin(data).then(res => {
                    if(res == "notFound"){
                        Toast({
                            message: '登陆失败',
                            iconClass: 'icon icon-error'
                        });
                    }else{
                        // 判断是否登录成功
                        if(res.code == '200'){
                            window.localStorage.setItem('userInfo',JSON.stringify(res.data));
                            this.loginStatus = true;
                            let that = this;
                             setTimeout(function () {
                                 that.$router.replace("/user");
                             },1000);
                        }
                        else{
                            Toast({
                                message: '手机号或密码错误',
                                iconClass: 'icon icon-error'
                            });
                        }
                    }
                });
                this.$store.commit('hideLoading')
            }
        }
    }
</script>


<style scoped>
    @import '../../static/css/login.css'
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
    .mint-button--primary {
        color: #fff !important;
        background-color: #26a2ff;
    }
</style>


