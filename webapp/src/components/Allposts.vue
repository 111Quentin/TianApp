<template>
    <div id="bg">
        <div class="title">
            <div class="left">
                <router-link to="/myposts">
                    <h2><strong>我的动态</strong>&nbsp;<i class="fa fa-angle-down"></i></h2>
                    <span>(全部)</span>
                </router-link>
            </div>
            <div class="right">
                <router-link to="/allposts"  class="curs">
                    <h2><strong>发现</strong></h2>
                </router-link>
            </div>

        </div>
        <div class="clear"></div>
        <div style="margin-bottom: 76px;"></div>
        <div class="content">
            <template v-for="(data,index) in postlist" >
                <div class="row">
                    <div class="userimg">
                        <img  v-if="data['member']['gender'] == '1' " src="static/images/man.jpg" alt="头像" width="70" height="70">
                        <img  v-else  src="static/images/woman.png" alt="头像" width="70" height="70">
                    </div>
                    <div class="intro">
                        <br>
                        <h3 v-if="data['member']['gender'] == '1' ">{{data['member']['username']}}&nbsp;&nbsp;  <i class="fa fa-mars" style="color:rgb(10, 163, 249);"></i>   </h3>
                        <h3 v-else>{{data['member']['username']}}&nbsp;&nbsp;<i class="fa fa-venus" style="color:rgb(255, 114, 146);"></i></h3>
                        <p style="font-size: 16px;">{{data['created_at']}}&nbsp;&nbsp;&nbsp;<i class="fa fa-trash-o" @click="del(data.id)" v-if="data['member']['id'] == userInfo.id"></i></p>
                    </div>
                    <div class="clear"></div>
                    <div class="article">
                        <p @click="goDetail(data.id)">{{data['content']}}</p>
                        <br>
                        <div class="files" v-if="data['files'] != '' " v-for="(data2,index2) in data['files']" :key="index2">
                            <img :src="data2" alt="" width="80%" align="center" v-if="data['files'].length == 1">
                            <img :src="data2" alt="" align="left" v-else style="width: calc(calc(100% / 3) - 10px);margin:3px;height:80px;box-sizing: border-box;">
                        </div>
                        <div  class="clear" style="margin-bottom: 30px;"></div>
                        <hr/>
                    </div>
                    <div class="icon">
                        <div class="icon1">
                            <a href="javascript:">
                                <p><i class="fa fa-share"></i>&nbsp;&nbsp;转发</p>
                            </a>
                        </div>
                        <div class="icon1">
                            <a href="javascript:">
                                <p @click="goDetail(data.id)"><i class="fa fa-commenting-o"></i>&nbsp;&nbsp;评论</p>
                            </a>
                        </div>
                        <div class="icon1">
                            <a href="javascript:">
                                <p @click="zan(data.id,index)" v-if="data['is_zan'] == '1' "><i class="fa fa-heart-o" ref="zan"   style="color: rgb(254, 112, 112);"></i>&nbsp;&nbsp;&nbsp;点赞</p>
                                <p @click="zan(data.id,index)" v-else><i class="fa fa-heart-o" ref="zan"></i>&nbsp;&nbsp;&nbsp;点赞</p>
                            </a>
                        </div>
                    </div>
                </div>
            </template>
            <div style="height: 17px;"></div>
        </div>
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
            <li class="cur">
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
    import { Toast,MessageBox} from 'mint-ui';
    import Refresh from '@/components/Refresh';
    export default {
        name: 'Allposts',
        data () {
            return {
                postlist:[],
                userInfo:[],
            }
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
                this.getPosts();
            }

        },
        watch:{
            '$route'(to,from){
                this.getPosts();
            }
        },
        methods:{
            goBack() {
                // 点击后退
                this.$router.go(-1);
            },
            // 获取当前用户的动态数据
            getPosts(){
                //TODO: 设置loading状态
                this.$store.commit('showLoading')
                // 请求获取当前用户的动态数据接口
                this.axios.get('http://120.79.74.212/api/posts/getall').then((response) =>{
                    if(response.status != 200 && response.data.code != 500){
                        Toast('操作失败,请稍后再试！');
                    }
                    else  if(response.status == 200 && response.data.code == 500){
                        Toast('暂无动态,请先发个动态先！');
                        this.$store.commit('hideLoading')
                    }
                    else{
                        this.postlist = response.data.data;
                        // console.log(this.postlist);
                        for(let obj of this.postlist){
                            if(obj.files === null){
                                this.refresh();
                            }
                            else{
                                let files = obj.files.split('&');
                                // 删除数组的最后一个空元素
                                files.splice(files.length-1,1);
                                obj.files = files;
                            }
                        }
                        this.$store.commit('hideLoading')
                    }
                })
            },
            // 刷新当前路由
            refresh(){
                this.$router.replace({
                    path: '/allposts',
                    query: {
                        t: Date.now()
                    }
                });
            },
            // 删除动态
            del(postId){
                MessageBox.confirm('', {
                    message: '你确定删除这条动态吗？',
                    title: '提示',
                    confirmButtonText: '确定',
                    cancelButtonText: '取消'
                }).then(action => {
                    if (action == 'confirm') {     //确认的回调
                        this.axios.get('http://120.79.74.212/api/posts/'+postId+'/delete').then((response) =>{
                            if(response.status != 200 && response.data.code != 200){
                                Toast('操作失败,请稍后再试！');
                            }
                            else{
                                this.refresh();
                            }
                        })
                    }
                }).catch(err => {
                    if (err == 'cancel') {     //取消的回调
                    }
                });
            },
            // 点赞
            zan(postId,index){
                this.axios.get('http://120.79.74.212/api/posts/'+postId+'/'+this.userInfo.id+'/zan').then((response) =>{
                    if(response.status != 200 && response.data.code != 501){
                        Toast('操作有误,请稍后再试！');
                    }
                    else if(response.status == 200 && response.data.code == '501'){
                        this.unzan(postId,index);
                    }
                    else{
                        // 点赞成功
                        // console.log(index);
                        // console.dir(this.$refs.zan[index]);
                        let zan = this.$refs.zan[index];
                        // console.log($('.fa-heart-o').eq(index));
                        $('.fa-heart-o').eq(index).css('color','rgb(254, 112, 112)');
                    }
                })
            },
            // 取消点赞
            unzan(postId,index){
                this.axios.get('http://120.79.74.212/api/posts/'+postId+'/'+this.userInfo.id+'/unzan').then((response) =>{
                    if(response.status != 200 && response.data.code != 501){
                        Toast('操作有误,请稍后再试！');
                    }
                    else if(response.status == 200 && response.data.code == '501'){
                        this.zan(postId,index);
                    }
                    else{
                        // 取消点赞成功
                        let zan = this.$refs.zan[index];
                        $('.fa-heart-o').eq(index).css('color','');
                    }
                })
            },
            goDetail(postId){
                this.$router.replace('/postsdetail/'+postId);
            }
        }
    }
</script>
<style scoped>
    @import '../../static/css/myposts.css'
</style>






