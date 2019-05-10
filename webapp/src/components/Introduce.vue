<template>
    <div class="wrapper">
         <div class="head">
             <h1>h5+PHP全栈实战</h1>
             <span>888人在学</span>
             <p>浏览量:89989</p>
         </div>
        <div class="main-message">
                <h3>课程介绍</h3>
               <span>这是专门面向想从事php全栈的同学开发的</span>
              <h3>适用人群</h3>
              <span>想从事IT软件开发的人群</span>
              <h3>提供方</h3>
            <div class="people">
                <img src="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2135429910,2001866011&fm=27&gp=0.jpg" alt="">
                <div class="people-detail">
                       <p>隔壁老王</p>
                     <span>是一个好人</span>
                </div>
            </div>
            <h3>讲师</h3>
            <div class="people">
                <img src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=3028269206,4116848032&fm=27&gp=0.jpg" alt="">
                <div class="people-detail">
                    <p>隔壁老王</p>
                    <span>没错就是我</span>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name:'introduce',
        props:{
            videos:''
        },
        methods:{
            // 播放视频方法
            // play(video){
            //     // console.log(JSON.stringify(this.videos));
            //     this.current = video;
            // }
        }
    }
</script>

<style scoped>
    @import '../../static/css/introduce.css'
</style>