<template>
    <div id="hot">
        <search :isSearching="false" @click.native="changeToSearch"></search>
        <!--轮播图-->
        <swiper :options="swiperOption" ref="mySwiper">
            <!-- slides -->
            <swiper-slide v-for="v in slides" :key="v.id">
               <router-link to="/video">
                   <img :src="v.path" alt="轮播图图片">
               </router-link>
            </swiper-slide>

            <!-- Optional controls -->
            <div class="swiper-pagination"  slot="pagination"></div>
            <div class="swiper-button-prev" slot="button-prev"></div>
            <div class="swiper-button-next" slot="button-next"></div>
            <div class="swiper-scrollbar"   slot="scrollbar"></div>
        </swiper>

        <!--轮播图结束-->

        <!--推荐视频-->
        <h2>推荐视频</h2>
        <div class="recommend">
           <router-link :to="{params:{lessonId:v.id},name:'Page'}" v-for="v in commendLesson" :key="v.id">
                   <img :src="v.preview" />
                   <!--<i class="iconfont icon-bofang"></i>-->
               <i class="fa fa-play-circle-o" style="font-size: 2em;color: #fff;"></i>
                   <span class="time">{{v.created_at | dateFormat}}</span>
                   <span class="title" style="font-size: 15px;">{{v.title}}</span>
           </router-link>
        </div>
        <!--推荐视频结束-->
        <a href="javascript:" class="more"  @click="getMore()">加载更多>></a>

        <!-- 热门视频-->
        <h2>热门视频</h2>
        <div >
            <mt-loadmore :bottom-method="loadBottom" :bottom-all-loaded="allLoaded" :auto-fill="false" :bottomPullText='bottomText' ref="loadmore">
                <div class="recommend">
                    <!--<ul>-->
                    <router-link :to="{params:{lessonId:v.id},name:'Page'}" v-for="v in hotLesson" :key="v.id">
                        <!--<li>-->
                        <div class="recommend-img">
                            <img :src="v.preview" />
                            <!--<i class="iconfont icon-bofang"></i>-->
                            <i class="fa fa-play-circle-o" style="font-size: 2em;color: #fff;"></i>
                            <span class="time">{{v.created_at | dateFormat}}</span>
                            <span class="title" style="font-size: 15px;">{{v.title}}</span>
                        </div>
                    </router-link>
                    <!--</ul>-->
                </div>
            </mt-loadmore>
        </div>
        <!--热门视频结束-->
        <a href="javascript:" class="more">上拉刷新>></a>
        <div style="height: 53px;"></div>
        <!--底部固定导航-->
        <ul id="bottom">
            <li class="cur">
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
            <li>
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
    import search from "@/components/search";
    import { Toast } from "mint-ui";
    import { Loadmore } from 'mint-ui';
    export default {
        components: {
            search
        },
        name: 'Home',
        // mounted生命周期函数,vue实例创建时自动调用
        mounted(){
            // 推荐课程
            this.getCommendVideos();
            // 热门课程
            this.getHotVideos();
        },
        data () {
            return {
                // 推荐课程
                commendLesson:[],
                // 热门课程
                hotLesson:[],
                commenedIndex: 1, // 默认显示第一页的数据
                hotIndex: 1, // 默认显示第一页的数据
                allLoaded:false,
                bottomText: '上拉加载更多...',
                slides: [
                    {id: 1, path: 'static/images/1.jpg'},
                    {id: 2, path: 'static/images/2.jpg'},
                    {id: 3, path: 'static/images/3.jpg'}
                ],
                swiperOption: {
                    // NotNextTick is a component's own property, and if notNextTick is set to true, the component will not instantiate the swiper through NextTick, which means you can get the swiper object the first time (if you need to use the get swiper object to do what Things, then this property must be true)
                    // notNextTick是一个组件自有属性，如果notNextTick设置为true，组件则不会通过NextTick来实例化swiper，也就意味着你可以在第一时间获取到swiper对象，假如你需要刚加载遍使用获取swiper对象来做什么事，那么这个属性一定要是true
                    notNextTick: true,
                    // swiper configs 所有的配置同swiper官方api配置
                    autoplay: 3000,
//                    direction : 'vertical',
                    grabCursor: true,
                    setWrapperSize: true,
                    autoHeight: true,
                    pagination: '.swiper-pagination',
                    paginationClickable: true,
                    prevButton: '.swiper-button-prev',
                    nextButton: '.swiper-button-next',
                    scrollbar: '.swiper-scrollbar',
                    mousewheelControl: true,
                    observeParents: true,
                }
            }
        },
        methods:{
            // 获取推荐视频方法
            getCommendVideos(){
                //TODO: 设置loading状态
                this.$store.commit('showLoading')
                // 推荐课程
                this.axios.get('http://120.79.74.212/api/commendLesson?pageIndex='+this.commenedIndex).then((response) => {
                    if(response.status != 200 && response.data.code != 200){
                        Toast('获取推荐视频失败,请稍后再试！');
                    }
                    else this.commendLesson = this.commendLesson.concat(response.data.data);
                    this.$store.commit('hideLoading')
                })
            },
            //获取热门视频数据的方法
            getHotVideos(){
                //TODO: 设置loading状态
                this.$store.commit('showLoading')
                this.axios.get('http://120.79.74.212/api/hotLesson?pageIndex='+this.hotIndex).then((response) => {
                    if(response.status != 200 && response.data.code != 200){
                        Toast('获取热门视频失败,请稍后再试！');
                    }
                    this.hotLesson = this.hotLesson.concat(response.data.data);
                    this.$store.commit('hideLoading')
                })
                //TODO: 设置loading状态
                this.$store.commit('showLoading')
            },
            changeToSearch(){
                this.$router.push({path:'search'});
            },
            // 加载更多
            getMore(){
                this.commenedIndex++;
                this.getCommendVideos();
            },
            // 上拉加载的方法
            loadBottom(){
                this.$refs.loadmore.onBottomLoaded();
                this.hotIndex++;
                this.getHotVideos();
            }
        }
    }
</script>

<style scoped>
    @import '../../static/css/home.css'
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

