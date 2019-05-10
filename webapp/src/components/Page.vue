<template>
    <div class="wrapper">
        <!--  页面顶部 -->
        <div class="header ">
            <mt-header  fixed title="视频播放页面" class="my_mint-header-title">
                   <span slot="left" @click="goBack">
                        <mt-button icon="back">返回</mt-button>
                   </span>
            </mt-header>
        </div>
        <!-- 页面顶部 -->
        <!--视频-->
        <div class="play">
            <video :src="current.path" controls="controls" autoplay></video>
            <!--视频结束-->
            <mt-navbar v-model="selected" >
                <mt-tab-item id="1">介绍</mt-tab-item>
                <mt-tab-item id="2">目录</mt-tab-item>
                <mt-tab-item id="3">评价</mt-tab-item>
            </mt-navbar>
            <mt-tab-container v-model="selected" swipeable>
                <mt-tab-container-item id="1">
                    <introduce :videos="videos"/>
                </mt-tab-container-item>
                <mt-tab-container-item id="2">
                    <catalog :videos="videos" :current="current" v-on:childByValue="childByValue"/>
                </mt-tab-container-item>
                <mt-tab-container-item id="3">
                    <comment :videos="videos" :videoId="videoId"/>
                </mt-tab-container-item>
            </mt-tab-container>
        </div>
    </div>
</template>


<script>
    import { Toast } from 'mint-ui';
    import introduce from "@/components/Introduce";
    import catalog from "@/components/Catalog";
    import comment from "@/components/Comment";
    export default {
        components:{
            introduce,
            catalog,
            comment
        },
        name: 'Page',
        created(){
             // 获取路由上的id(也可理解为是url地址的id)
            let lessonId = this.$route.params.lessonId;
            //TODO: 设置loading状态
            this.$store.commit('showLoading')
            // 推荐课程视频
            this.axios.get('http://120.79.74.212/api/videos/' + lessonId).then((response) => {
                  if(response.status != 200 && response.data.code != 200){
                      Toast('获取课程视频失败,请稍后再试！');
                  }
                  else{
                      this.videos = response.data.data;
                      this.current = this.videos[0]; // 默认播放第一个视频
                      this.videoId = this.current.id;
                      this.$store.commit('hideLoading')
                      // console.log(this.videoId);
                  }
            })
        },
        data () {
            return {
                 // 当前视频
                current:[],
                // 视频列表
                videos:[],
                selected: "1",
                // 视频id
                videoId:''
            }
        },
        methods:{
            // 播放视频方法
            play(video){
                this.current = video;
            },
            // 返回上一页方法
            goBack(){
                this.$router.back();
            },
            childByValue: function(childValue){
                this.current = childValue;
                this.videoId = this.current.id;
            }
        }
    }
</script>



<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    @import '../../static/css/page.css'
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


