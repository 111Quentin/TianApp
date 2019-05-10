<template>
    <div class="shopcar-container" style="padding-top: 45px;">

        <!--  页面顶部 -->
        <div class="header">
            <mt-header  fixed title="购物车" class="my_mint-header-title">
                   <span slot="left" @click="goBack">
                        <mt-button icon="back">返回</mt-button>
                   </span>
            </mt-header>
        </div>
        <div class="goods-list">

            <!-- 商品列表项区域 -->
            <div class="mui-card">
                <div class="mui-card-content">
                    <div class="mui-card-content-inner">
                            <div class="mui-content" style="background-color: #fff;">
                                <!--<form class="mui-input-group">-->
                                 <div>
                                     <h1 align="center" style="padding: 10px;font-size: 20px;">收货人信息</h1>
                                 </div>
                                    <div class="mui-input-row">
                                        <label>用户名</label>
                                        <input type="text" class="mui-input-clear mui-input" placeholder="请输入用户名" v-model="userInfo.username">
                                    </div>
                                    <div class="mui-input-row">
                                        <label>联系方式</label>
                                        <input type="tel" class="mui-input-clear mui-input" placeholder="请输入手机号" name="mobile" v-model="userInfo.mobile">
                                    </div>
                                    <div class="mui-input-row" style="margin: 10px 5px;">
                                        <label>收货地点</label>
                                        <textarea id="textarea" rows="5" placeholder="请输入收货地点"  name="place" style="padding-left: 8px;padding-top: 7px;background-color: #eee;"></textarea>
                                    </div>

                                <!--</form>-->
                            </div>
                    </div>
                </div>
            </div>
            <!-- 商品列表项区域 -->
            <div class="mui-card" v-for="(item, i) in bookslist" :key="item.id">
                <div class="mui-card-content">
                    <div class="mui-card-content-inner">
                        <mt-switch
                                v-model="$store.getters.getBooksSelected[item.id]"
                                @change="selectedChanged(item.id, $store.getters.getBooksSelected[item.id])"></mt-switch>
                        <img :src="item.goods_thumb">
                        <div class="info">
                            <h1>{{ item.title }}</h1>
                            <p>
                                <span class="price">￥{{ item.shop_price }}</span>
                                <numbox :initcount="$store.getters.getBooksCount[item.id]" :booksid="item.id"></numbox>
                                <!-- 问题：如何从购物车中获取商品的数量呢 -->
                                <!-- 1. 我们可以先创建一个 空对象，然后循环购物车中所有商品的数据， 把 当前循环这条商品的 Id， 作为 对象 的 属性名，count值作为 对象的 属性值，这样，当把所有的商品循环一遍，就会得到一个对象： { 88: 2, 89: 1, 90: 4 } -->
                                <a href="#" @click.prevent="remove(item.id,  i)">删除</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- 结算区域 -->
        <div class="mui-card">
            <div class="mui-card-content">
                <div class="mui-card-content-inner jiesuan">
                    <div class="left">
                        <p>总计（不含运费）</p>
                        <p>已勾选商品 <span class="red">{{ $store.getters.getBooksCountAndAmount.count }}</span> 件， 总价 <span class="red">￥{{ $store.getters.getBooksCountAndAmount.amount }}</span></p>
                    </div>
                    <mt-button type="danger">去结算</mt-button>
                </div>
            </div>
        </div>
        <!--<p>{{ $store.getters.getBooksSelected }}</p>-->
    </div>
</template>

<script>
    import { Toast} from 'mint-ui';
    // 导入 数字选择框 组件
    import numbox from "@/components/Shopcart_numbox";
    export default {
        data() {
            return {
                bookslist: [], // 购物车中所有商品的数据,
                booksArr:[],
                userInfo:[], // 存储用户信息
            };
        },
        mounted(){
            let userInfo = JSON.parse(window.localStorage.getItem('userInfo'));  // 将localStorage的值转换成对象
            // 验证是否登录,没有就跳转到登录页
            if(!userInfo){
                Toast({
                    message: '请先登录！',
                    iconClass: 'icon icon-error'
                });
                this.$router.replace("/login");
            }
            else{
                this.userInfo = userInfo;
            }
        },
        created() {
            this.getBookslist();
        },
        methods: {
            goBack() {
                // 点击后退
                this.$router.go(-1);
            },
            getBookslist() {
                // 1. 获取到 store 中所有的商品的Id，然后拼接出一个 用逗号分隔的 字符串
                var idArr = [];
                this.$store.state.car.forEach(item => idArr.push(item.id));
                // 如果 购物车中没有商品，则直接返回，不需要请求数据接口，否则会报错
                if (idArr.length <= 0) {
                    return;
                }
                // 获取购物车商品列表
                this.axios.get('http://120.79.74.212/api/books/getShopcarlist/'+idArr.join(",")).then((response) =>{
                    if(response.status != 200 && response.data.code != 200){
                        Toast('操作失败,请稍后再试！');
                        this.$store.commit('hideLoading')
                    }
                    else  if(response.status == 200 && response.data.code == 500){
                        Toast('获取购物车数据失败');
                        this.$store.commit('hideLoading')
                    }
                    else{
                        this.bookslist = response.data.data;
                        // console.log(this.bookslist);
                    }
                    this.$store.commit('hideLoading')
                })
            },
            remove(id, index) {
                // 点击删除，把商品从 store 中根据 传递的 Id 删除，同时，把 当前组件中的 goodslist 中，对应要删除的那个商品，使用 index 来删除

                // 这里得到的this.bookslist是一个对象，要使用splice方法，需要转换成数组
                 for(let i in this.bookslist){
                     this.booksArr.push(this.bookslist[i]);
                 }
                 // console.log(this.booksArr);
                this.booksArr.splice(index,1);
                this.$store.commit("removeFormCar", id);
            },
            selectedChanged(id, val) {
                // 每当点击开关，把最新的 快关状态，同步到 store 中
                // console.log(id + " --- " + val);
                this.$store.commit("updateBooksSelected", { id, selected: val });
            },
            // 用户名验证
            checkname(){
                if(this.userInfo.username == ""){
                    Toast({
                        message: '请填写用户名',
                        iconClass: 'icon icon-error',
                        position: 'top',
                    });
                    return;  // 跳出if条件
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
        },
        components: {
            numbox
        }
    };
</script>
<style scoped>
    @import '../../static/css/shopcart.css'
</style>
<style lang="scss" scoped>
    .shopcar-container {
        background-color: #eee;
        overflow: hidden;
        .goods-list {
            .mui-card-content-inner {
                display: flex;
                align-items: center;
            }
            img {
                width: 60px;
            }
            h1 {
                font-size: 13px;
            }
            .info {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                .price {
                    color: red;
                    font-weight: bold;
                }
            }
        }
        .jiesuan {
            display: flex;
            justify-content: space-between;
            align-items: center;
            .red {
                color: red;
                font-weight: bold;
                font-size: 16px;
            }
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
    .shopcar-container .jiesuan[data-v-21acea58] {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .mui-card-content-inner {
        position: relative;
        padding: 15px;
    }
    .mint-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 4px;
        border: 0;
        box-sizing: border-box;
        color: inherit;
        display: block;
        font-size: 18px;
        height: 41px;
        outline: 0;
        overflow: hidden;
        position: relative;
        text-align: center;
    }
    .mint-button--normal {
        display: inline-block;
        padding: 0 12px;
    }
    .mint-button--danger {
        color: #fff;
        background-color: #ef4f4f;
    }
</style>
