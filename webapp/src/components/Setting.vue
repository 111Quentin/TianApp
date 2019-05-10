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
            <router-link to="/aboutus">
                <mt-cell title="关于TianAPP" is-link>
                </mt-cell>
            </router-link>
        </div>
        <mt-button size="large" type="danger" @click="logout()">退出登录</mt-button>
        <!-- 页面主体 -->
    </div>
</template>

<script>
    import { Toast } from 'mint-ui';
    export default {
        name: 'Setting',
        data () {
            return {
            }
        },
        mounted(){
            let userInfo = JSON.parse(window.localStorage.getItem('userInfo'));  // 将localStorage的值转换成对象
            if(!userInfo){
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
            },
            logout(){
                     window.localStorage.removeItem('userInfo');
                     Toast({
                         message: '退出登录成功',
                         iconClass: 'icon icon-success'
                     });
                     this.$router.replace("/user");
            }
        }
    }
</script>


<style scoped>
    @import '../../static/css/setting.css'
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
