<template>
    <div class="goodsinfo-container" style="padding-top: 45px;">
        <!--  页面顶部 -->
        <div class="header">
            <mt-header  fixed title="书城中心" class="my_mint-header-title">
                   <span slot="left" @click="goBack">
                        <mt-button icon="back">返回</mt-button>
                   </span>
            </mt-header>
        </div>
        <transition
                @before-enter="beforeEnter"
                @enter="enter"
                @after-enter="afterEnter">
            <div class="ball" v-show="ballFlag" ref="ball"></div>
        </transition>

        <template  v-for="(data,index) in booksinfo">
                <!-- 商品轮播图区域 -->
                <div class="mui-card">
                    <div class="mui-card-content">
                        <div class="mui-card-content-inner">
                            <swiper :lunbotuList="lunbotu" :isfull="false"></swiper>
                        </div>
                    </div>
                </div>
                <!-- 商品购买区域 -->
                <div class="mui-card">
                    <div class="mui-card-header">{{data['goods_name']}}</div>
                    <div class="mui-card-content" align="left">
                        <div class="mui-card-content-inner">
                            <p class="price">
                                市场价：<del class="old">￥{{data['market_price']}}</del>&nbsp;&nbsp;&nbsp;销售价：<span class="now_price">￥{{data['shop_price']}}</span>
                            </p>
                            <p>购买数量：<numbox @getcount="getSelectedCount" :max="data['goods_nums']"></numbox></p>
                            <p>
                                <mt-button type="primary" size="small" style="color: #fff !important;">立即购买</mt-button>
                                <mt-button type="danger" size="small" @click="addToShopCar">加入购物车</mt-button>
                                <!--<mt-button type="danger" size="small">加入购物车</mt-button>-->
                                <!-- 分析： 如何实现加入购物车时候，拿到 选择的数量 -->
                                <!-- 1. 经过分析发现： 按钮属于 goodsinfo 页面， 数字 属于 numberbox 组件 -->
                                <!-- 2. 由于涉及到了父子组件的嵌套了，所以，无法直接在 goodsinfo 页面zhong 中获取到 选中的商品数量值-->
                                <!-- 3. 怎么解决这个问题：涉及到了 子组件向父组件传值了（事件调用机制） -->
                                <!-- 4. 事件调用的本质： 父向子传递方法，子调用这个方法， 同时把 数据当作参数 传递给这个方法 -->
                            </p>
                        </div>
                    </div>
                </div>
                <!-- 商品参数区域 -->
                <div class="mui-card">
                    <div class="mui-card-header">商品参数</div>
                    <div class="mui-card-content" align="left">
                        <div class="mui-card-content-inner">
                            <p>商品货号：{{data['goods_sn']}}</p>
                            <p>库存情况：{{data['goods_nums']}}</p>
                            <p>上架时间：{{data['created_at']}}</p>
                        </div>
                    </div>
                    <div class="mui-card-footer" style="margin-bottom: 60px;padding-left:18px;padding-right: 18px;">
                        <mt-button type="primary" size="large" plain>图文介绍</mt-button>
                        <mt-button type="danger" size="large" plain>商品评论</mt-button>
                        <!--<mt-button type="primary" size="large" plain @click="goDesc(id)">图文介绍</mt-button>-->
                        <!--<mt-button type="danger" size="large" plain @click="goComment(id)">商品评论</mt-button>-->
                    </div>
                </div>
        </template>
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
    import swiper from "@/components/Swiper";
    // 导入 数字选择框 组件
     import numbox from "@/components/Books_numbox";

    export default {
        name: 'Booksdetail',
        data() {
            return {
                bookid: this.$route.params.bookid, // 将路由参数对象中的 id 挂载到 data , 方便后期调用
                lunbotu: [], // 轮播图的数据
                booksinfo: [], // 获取到的商品的信息
                ballFlag: false, // 控制小球的隐藏和显示的标识符
                selectedCount: 1, // 保存用户选中的商品数量， 默认，认为用户买1个
            };
        },
        created() {
            this.getBooks();
        },
        methods: {
            goBack() {
                // 点击后退
                this.$router.go(-1);
            },
            // 获取图书数据
            getBooks(){
                //TODO: 设置loading状态
                this.$store.commit('showLoading')
                // 请求获取当前用户的动态数据接口
                this.axios.get('http://120.79.74.212/api/books/'+this.bookid+'/getBook').then((response) =>{
                    if(response.status != 200 && response.data.code != 200){
                        Toast('操作失败,请稍后再试！');
                        this.$store.commit('hideLoading')
                    }
                    else  if(response.status == 200 && response.data.code == 500){
                        Toast('暂无图书信息');
                        this.$store.commit('hideLoading')
                    }
                    else{
                        this.booksinfo = response.data.data;
                        for (let i =0;i<3;i++){
                            this.lunbotu.push(this.booksinfo[0].goods_thumb);
                        }
                    }
                    this.$store.commit('hideLoading')
                })
            },
            // goDesc(id) {
            //     // 点击使用编程式导航跳转到 图文介绍页面
            //     this.$router.push({ name: "goodsdesc", params: { id } });
            // },
            goComment(id) {
                // 点击跳转到 评论页面
                this.$router.push({ name: "goodscomment", params: { id } });
            },
            addToShopCar() {
                // 添加到购物车
                this.ballFlag = !this.ballFlag;
                // { id:商品的id, count: 要购买的数量, price: 商品的单价，selected: false  }
                // 拼接出一个，要保存到 store 中 car 数组里的 商品信息对象
                var booksinfo = {
                    id: this.bookid,
                    count: this.selectedCount,
                    price: this.booksinfo[0].shop_price,
                    selected: true
                };
                // 调用 store 中的 mutations 来将商品加入购物车
                this.$store.commit("addToCar", booksinfo);
            },
            beforeEnter(el) {
                el.style.transform = "translate(0, 0)";
            },
            enter(el, done) {
                el.offsetWidth;
                // 小球动画优化思路：
                // 1. 先分析导致 动画 不准确的 本质原因： 我们把 小球 最终 位移到的 位置，已经局限在了某一分辨率下的 滚动条未滚动的情况下；
                // 2. 只要分辨率和 测试的时候不一样，或者 滚动条有一定的滚动距离之后， 问题就出现了；
                // 3. 因此，我们经过分析，得到结论： 不能把 位置的 横纵坐标 直接写死了，而是应该 根据不同情况，动态计算这个坐标值；
                // 4. 经过分析，得出解题思路： 先得到 徽标的 横纵 坐标，再得到 小球的 横纵坐标，然后 让 y 值 求差， x 值也求 差，得到 的结果，就是横纵坐标要位移的距离
                // 5. 如何 获取 徽标和小球的 位置？？？   domObject.getBoundingClientRect()

                // 获取小球的 在页面中的位置
                const ballPosition = this.$refs.ball.getBoundingClientRect();
                // 获取 徽标 在页面中的位置
                const badgePosition = document
                    .getElementById("badge")
                    .getBoundingClientRect();

                const xDist = badgePosition.left - ballPosition.left;
                const yDist = badgePosition.top - ballPosition.top;

                el.style.transform = `translate(${xDist}px, ${yDist}px)`;
                el.style.transition = "all 0.5s cubic-bezier(.4,-0.3,1,.68)";
                done();
            },
            afterEnter(el) {
                this.ballFlag = !this.ballFlag;
            },
            getSelectedCount(count) {
                // 当子组件把 选中的数量传递给父组件的时候，把选中的值保存到 data 上
                this.selectedCount = count;
                // console.log("父组件拿到的数量值为： " + this.selectedCount);
            }
        },
        // 子组件
        components: {
            swiper,
            numbox
        }
    };
</script>
<style scoped>
    @import '../../static/css/booksdetail.css'
</style>
<style lang="scss" scoped>
    .goodsinfo-container {
        background-color: #eee;
        overflow: hidden;
        height: auto;
        .now_price {
            color: red;
            font-size: 16px;
            font-weight: bold;
        }

        .mui-card-footer {
            display: block;
            button {
                margin: 15px 0;
            }
        }

        .ball {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: red;
            position: absolute;
            z-index: 99;
            top: 390px;
            left: 146px;
        }
    }
</style>

<style>
    button:enabled:active, input[type=button].mui-active:enabled, input[type=button]:enabled:active, input[type=reset].mui-active:enabled, input[type=reset]:enabled:active, input[type=submit].mui-active:enabled, input[type=submit]:enabled:active {
        color: #fff;
        background-color: #26a2ff;
    }
    .mui-card {
        font-size: 14px;
        position: relative;
        overflow: hidden;
        margin: 10px;
        border-radius: 2px;
        background-color: #fff;
        background-clip: padding-box;
        box-shadow: 0 1px 2px rgba(0,0,0,.3);
    }
    .mui-card-content {
        font-size: 14px;
        position: relative;
    }
    .mui-card-content-inner {
        position: relative;
        padding: 15px;
    }
    .mui-card-content-inner p{
        font-size: 14px;
        margin-top: 0;
        margin-bottom: 15px;
        color: #8f8f94;
    }
    .mui-card-header {
        font-size: 17px;
        border-radius: 2px 2px 0 0;
        padding-left: 12px;
    }
    .old {
        text-decoration: line-through;
        font-size: 12px;
    }

    .mint-button--small {
        display: inline-block;
        font-size: 14px;
        padding: 0 12px;
        height: 33px;
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

    .mint-button--primary.is-plain {
        border: 1px solid #26a2ff;
        background-color: transparent;
        color: #26a2ff !important;
    }
</style>
