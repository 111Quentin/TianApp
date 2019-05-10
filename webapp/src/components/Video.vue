<template>
  <div>
    <!--导航条-->
    <swiper :options="swiperOption">
      <swiper-slide v-for="v in tags" :key="v.id">
          <router-link :to="{params:{tid:v.id},name:'Video'}">
            {{v.name}}
          </router-link>
      </swiper-slide>
      <!--<div class="swiper-pagination" slot="pagination"></div>-->
    </swiper>

    <!--导航条结束-->

    <!--视频列表-->
    <ul id="videolist">
      <li v-for="v in lesson" :key="v.id">
        <router-link class="pic" :to="{params:{lessonId:v.id},name:'Page'}">
            <img :src="v.preview"/>
            <span>{{v.created_at | dateFormat}}</span>
            <i class="fa fa-play-circle-o" style="font-size: 2em;color: #fff;"></i>
        </router-link>
       <router-link class="title" :to="{params:{lessonId:v.id},name:'Page'}">
         {{v.title}}
       </router-link>
      </li>
    </ul>
    <!--视频列表结束-->


    <!--底部固定导航-->
      <ul id="bottom">
          <li>
              <!-- router-link最后是转化成a链接的-->
              <router-link to="/">
                  <!--<i class="iconfont icon-shouye1"></i>-->
                  <i class="fa fa-home" style="font-size: 1.5em;"></i>
                  <span>首页</span>
              </router-link>
          </li>
          <li class="cur">
              <router-link to="/video">
                  <!--<i class="iconfont icon-video"></i>-->
                  <i class="fa fa-film" style="font-size: 1.5em;"></i>
                  <span>视频</span>
              </router-link>
          </li>
          <li>
              <router-link to="/myposts">
                  <!--<i class="iconfont icon-icon_message"></i>-->
                  <i class="fa fa-commenting-o" style="font-size: 1.5em;"></i>
                  <span>下课聊</span>
              </router-link>
          </li>
          <li>
              <router-link to="/books">
                  <!--<i class="iconfont icon-icon_addresslist"></i>-->
                  <i class="fa fa-book" style="font-size: 1.5em;"></i>
                  <span>书城</span>
              </router-link>
          </li>
          <li>
              <router-link to="/shopcart">
                    <span class="mui-icon mui-icon-extra">
					    <span class="mui-badge" id="badge">{{ $store.getters.getAllCount }}</span>
				   </span>
                  <!--<i class="iconfont icon-gouwuche"></i>-->
                  <i class="fa fa-shopping-cart" style="font-size: 1.5em;"></i>
                  <span>购物车</span>
              </router-link>
          </li>
          <li>
              <router-link to="/user">
                  <!--<i class="iconfont icon-account"></i>-->
                  <i class="fa fa-user-o" style="font-size: 1.5em;"></i>
                  <span>个人中心</span>
              </router-link>
          </li>
      </ul>
    <!--底部固定导航结束-->
  </div>
</template>

<script>
import { Toast } from 'mint-ui';
export default {
  name: 'Video',
  // 通过监听路由的地址的改变进行调用
  watch:{
      '$route'(to,from){
        this.loadData();
      }
  },
  // mounted 只执行一次
  mounted(){
    this.loadData();
  },
  data () {
    return {
      tags:[],
      lesson:[],
      swiperOption: {
        slidesPerView: 3,
        spaceBetween: 30,
        freeMode: true,
        pagination: {
          el: '.swiper-pagination',
          clickable: true
        }
      }
    }
  },
  methods:{
      loadData(){
      //TODO: 设置loading状态
      this.$store.commit('showLoading')
      // 获取标签
      this.axios.get('http://120.79.74.212/api/tags' ).then((response) => {
          if(response.status != 200 && response.data.code != 200){
              Toast('获取课程标签数据失败,请稍后再试！');
          }
         else{
              this.tags = response.data.data;
              this.$store.commit('hideLoading')
          }
      })

      // 获取课程
      let tid = this.$route.params.tid;
      // 推荐课程视频
      this.axios.get('http://120.79.74.212/api/lesson/' + (tid ? tid : 0)).then((response) => {
        this.lesson = response.data.data;
      })
    }
}
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    @import '../../static/css/video.css'
</style>
<style>
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
</style>
