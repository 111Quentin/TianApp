<template>
    <div>
        <!--  页面顶部 -->
        <div class="header ">
            <mt-header  fixed title="关于我们" class="my_mint-header-title">
                   <span slot="left" @click="goBack">
                        <mt-button icon="back">返回</mt-button>
                   </span>
            </mt-header>
        </div>
        <!-- 页面顶部 -->
        <!-- 页面内容-->
        <div class="main">
              <div class="title">
                  <img src="/static/images/tian.png" alt="" width="50" height="50">
                  <span>TianAPP</span><br>
                  <span>实现你的IT梦</span>
              </div>
            <div class="content">
                <img src="/static/images/download.png" alt="">
                <br> <br>
                <h4>扫一扫,马上安装</h4>
            </div>
        </div>
    </div>

</template>

<script>
    import { Toast } from 'mint-ui';
    export default {
        name: 'Aboutus',
        data () {
            return {
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
    @import '../../static/css/aboutus.css'
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
