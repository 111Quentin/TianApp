<template>
    <!-- 页面顶部 -->
    <div class="goods-list" style="padding-top: 45px;">
        <!--  页面顶部 -->
        <div class="header">
            <mt-header  fixed title="书城中心" class="my_mint-header-title">
                   <span slot="left" @click="goBack">
                        <mt-button icon="back">返回</mt-button>
                   </span>
            </mt-header>
        </div>
        <div class="goods-item" v-for="(data,index) in bookslist" @click="goDetail(data.id)">
            <img  :src="data['goods_thumb']" alt="" >
            <h1 class="title">{{data['goods_name']}}</h1>

            <div class="info">
                <p class="price">
                    <span class="now">￥{{data['shop_price']}}</span>
                    <span class="old">￥{{data['market_price']}}</span>
                </p>
                <p class="sell">
                    <span>热卖中</span>
                    <span>剩{{data['goods_nums']}}本</span>
                </p>
            </div>
        </div>
            <mt-button id="more" type="danger" size="large" @click="getMore()" style="margin-bottom: 50px;display: none">加载更多</mt-button>
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
            <li class="cur">
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
    import { Toast} from 'mint-ui';
    import Refresh from '@/components/Refresh';
    export default {
        name: 'Books',
        data () {
            return {
                bookslist:[],
                pageIndex: 1, // 默认显示第一页的数据
            }
        },
        mounted(){
           this.getBooks();
        },
        watch:{

        },
        methods:{
            goBack() {
                // 点击后退
                this.$router.go(-1);
            },
            // 刷新当前路由
            refresh(){
                this.$router.replace({
                    path: '/myposts',
                    query: {
                        t: Date.now()
                    }
                });
            },
            // 获取图书数据
            getBooks(){
                //TODO: 设置loading状态
                this.$store.commit('showLoading')
                // 请求获取当前用户的动态数据接口
                this.axios.get('http://120.79.74.212/api/books/getBooks?pageIndex='+this.pageIndex).then((response) =>{
                    if(response.status != 200 && response.data.code != 200){
                        Toast('操作失败,请稍后再试！');
                        this.$store.commit('hideLoading')
                    }
                    else  if(response.status == 200 && response.data.code == 500){
                        Toast('暂无图书信息');
                        this.$store.commit('hideLoading')
                    }
                    else this.bookslist = this.bookslist.concat(response.data.data);
                    $('#more').show();
                    // console.log(this.bookslist);
                    this.$store.commit('hideLoading')
                })
            },
            // 跳转至详情页面
            goDetail(booksId){
                 this.$router.replace('/booksdetail/'+booksId+'/');
            },
            //加载更多
            getMore(){
                this.pageIndex++;
                this.getBooks();
            }
        }
    }
</script>
<style scoped>
    @import '../../static/css/books.css'
</style>
<style lang="scss" scoped>
    .goods-list {
        display: flex;
        flex-wrap: wrap;
        padding: 7px;
        justify-content: space-between;

        .goods-item {
            width: 49%;
            border: 1px solid #ccc;
            box-shadow: 0 0 8px #ccc;
            margin: 4px 0;
            padding: 2px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 293px;
            img {
                width: 100%;
            }
            .title {
                font-size: 14px;
            }

            .info {
                background-color: #eee;
                p {
                    margin: 0;
                    padding: 5px;
                }
                .price {
                    .now {
                        color: red;
                        font-weight: bold;
                        font-size: 16px;
                    }
                    .old {
                        text-decoration: line-through;
                        font-size: 12px;
                        margin-left: 10px;
                    }
                }
                .sell {
                    display: flex;
                    justify-content: space-between;
                    font-size: 13px;
                }
            }
        }
    }
</style>
<style>
    button:enabled:active, input[type=button].mui-active:enabled, input[type=button]:enabled:active, input[type=reset].mui-active:enabled, input[type=reset]:enabled:active, input[type=submit].mui-active:enabled, input[type=submit]:enabled:active {
        color: #fff;
        background-color: #26a2ff;
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
</style>







