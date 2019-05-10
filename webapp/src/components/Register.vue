<template>
    <div>
        <!--  页面顶部 -->
        <div class="header ">
            <mt-header title="注册界面" class="my_mint-header-title">
                   <span slot="left" @click="goBack">
                        <mt-button icon="back">返回</mt-button>
                   </span>
            </mt-header>
        </div>
        <!-- 页面顶部 -->

        <!-- 页面主体 -->
        <div class="content">
            <mt-field label="用户名" placeholder="请输入用户名" v-model="username" @change="checkname()"></mt-field>
            <mt-field label="邮箱" placeholder="请输入邮箱" type="email" v-model="email" @change="checkemail()"></mt-field>
            <mt-field label="密码" placeholder="请输入密码" type="password" v-model="passwd" @change="checkepasswd()"></mt-field>
            <mt-field label="重复密码" placeholder="再次输入密码" type="password" v-model="repasswd" @change="checkrepasswd()"></mt-field>
            <mt-field label="手机号" placeholder="请输入手机号" v-model="mobile" @change="checkmobile()" ></mt-field>
            <div align="left" class="radio line">
               <mt-radio title="性别"   align="left" :options="options" class="sex" v-model="gender"></mt-radio>
           </div>
            <div class="res">
                <mt-button size="large" type="primary" @click="register()">注册</mt-button>
            </div>
        </div>
        <!-- 页面主体 -->
    </div>
</template>

<script>
    import  { requestRegister } from "../api/api";
    import { Toast } from 'mint-ui';
    export default {
        name: 'Register',
        data () {
            return {
                 // 用户名
                username:'',
                // 邮箱
                email:'',
                // 密码
                passwd:'',
                // 重复密码
                repasswd:'',
                // 手机号
                mobile:'',
                // 性别
                gender:'1',
                // 性别选项
                options:[
                     {label: '男',value:'1'},
                    {label: '女',value:'2'},
                    {label: '未知',value:'3'}
                ]
            }
        },
        methods:{
            goBack() {
                // 点击后退
                this.$router.go(-1);
            },
            // 用户名验证
            checkname(){
                 if(this.username == ""){
                     Toast({
                         message: '请填写用户名',
                         iconClass: 'icon icon-error',
                         position: 'top',
                     });
                     return;  // 跳出if条件
                 }
            },

            // 邮箱验证
            checkemail(){
                let regEmail=/^[a-zA-Z0-9_-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/;
                if(this.email==''){
                    Toast({
                        message: '请填写邮箱',
                        iconClass: 'icon icon-error',
                        position: 'top',
                    });
                }else if(!regEmail.test(this.email)){
                    Toast({
                        message: '邮箱格式有误!',
                        iconClass: 'icon icon-error',
                        position: 'top',
                    });
                    this.email = '';
                }
            },

            // 密码验证
            checkepasswd(){
                if(this.passwd==''){
                    Toast({
                        message: '请填写密码',
                        iconClass: 'icon icon-error',
                        position: 'top',
                    });
                }
            },

            // 重复密码验证
            checkrepasswd(){
                if(this.repasswd == ''){
                    Toast({
                        message: '请再次填写密码',
                        iconClass: 'icon icon-error',
                        position: 'top',
                    });
                }else if(this.passwd != this.repasswd){
                    Toast({
                        message: '密码不一致!',
                        iconClass: 'icon icon-error',
                        position: 'top',
                    });
                }
            },

            // 手机号验证
            checkmobile(){
                let myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
                if(this.mobile==''){
                    Toast({
                        message: '请填写手机号',
                        iconClass: 'icon icon-error',
                        position: 'top',
                    });
                }else if(!myreg.test(this.mobile)){
                    Toast({
                        message: '手机格式有误!',
                        iconClass: 'icon icon-error',
                        position: 'top',
                    });
                }
            },
            // 注册方法
            register(){
                  // 验证
                  if(!this.username || !this.passwd  || !this.mobile ||  !this.gender || !this.email){
                      Toast({
                          message: '请填写完整信息',
                          iconClass: 'icon icon-error',
                          position: 'top',
                      });
                      return;  // 跳出if条件
                  }
                  else{
                      // 将数据存储到data
                      let data = {
                          username: this.username,
                          passwd: this.passwd,
                          gender: this.gender,
                          mobile: this.mobile,
                          email: this.email
                      };

                      //TODO: 设置loading状态

                      // 把data作为params传递给注册接口
                      requestRegister(data).then(res =>{
                            if(res.code == '200'){
                                Toast({
                                    message: '注册成功!',
                                    iconClass: 'icon icon-success'
                                });
                                let that = this;
                                setTimeout(function () {
                                    that.$router.replace("/login");
                                },1000);
                            }
                            else{
                                Toast({
                                    message: '填写信息有误！',
                                    iconClass: 'icon icon-error'
                                });
                            }
                      });
                  }
            }
        }
    }
</script>


<style scoped>
    @import '../../static/css/register.css'
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

    .sex label{
        font-size: 16px;
        color:#1b1a1a;
    }

    .line a{
        text-decoration: none;
    }

</style>


