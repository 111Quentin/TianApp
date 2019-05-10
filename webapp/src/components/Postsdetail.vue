<template>
    <div id="bg">
        <div class="title">
            <router-link to="/myposts" class="left">
                <span><i class="fa fa-angle-left"></i></span>
            </router-link>
            <h3 style="padding-top: 19px;margin-right: 30px;">动态详情</h3>
        </div>
        <div class="clear"></div>
        <div class="content">
            <template v-for="(data,index) in postlist" >
                <div class="row">
                    <div class="userimg">
                        <img :src="img" alt="头像" width="70" height="70">
                    </div>
                    <div class="intro">
                        <br>
                        <h3 v-if="userInfo['gender'] == '1' ">{{userInfo['username']}}&nbsp;&nbsp;  <i class="fa fa-mars" style="color:rgb(10, 163, 249);"></i>   </h3>
                        <h3 v-else>{{userInfo['username']}}&nbsp;&nbsp;<i class="fa fa-venus" style="color:rgb(255, 114, 146);"></i></h3>
                        <p style="font-size: 16px;color: #000;">{{data['created_at']}}&nbsp;&nbsp;&nbsp;<i class="fa fa-trash-o" @click="del(data.id)"></i></p>
                    </div>
                    <div class="clear"></div>
                    <div class="article">
                        <p>{{data['content']}}</p>
                        <br>
                        <div class="files" v-if="data['files'] != '' " v-for="(data2,index2) in data['files']" :key="index2">
                            <img :src="data2" alt="" width="80%" align="center" v-if="data['files'].length == 1">
                            <img :src="data2" alt="" align="left" v-else style="width: calc(calc(100% / 3) - 10px);margin:3px;height:80px;box-sizing: border-box;">
                        </div>
                        <div  class="clear" style="margin-bottom: 30px;"></div>
                    </div>
                </div>
            </template>
                <div class="comlist">
                    <div class="comtitle">
                        <h3>评论</h3>
                        &nbsp;<span style="font-size: 20px;">{{commentList['allcount']}}</span>
                    </div>
                    <template v-for="(data,index) in commentList">
                        <div class="comrow" v-if="data != commentList['allcount'] && data['parent_id'] == 0">
                            <div class="userimg">
                                <img  :src="img" alt="头像" width="70" height="70">
                            </div>
                            <div class="intro">
                                <br>
                                <h3  v-if="data['owner']['gender'] == '1' "> {{data['owner']['username']}}&nbsp;<i class="fa fa-mars" style="color:rgb(10, 163, 249);"></i> </h3>
                                <h3 v-else>{{data['owner']['username']}}&nbsp;&nbsp;<i class="fa fa-venus" style="color:rgb(255, 114, 146);"></i></h3>
                                <p style="font-size: 16px;">{{data['created_at']}}</p>
                            </div>
                            <div class="comicon">
                                <span><i class="fa fa-thumbs-o-up"></i></span>
                                <span>&nbsp;&nbsp;&nbsp;<i class="fa fa-commenting-o" @click="comson(data.id)"></i></span>
                            </div>
                            <div class="clear"></div>
                            <div class="comcontent" >
                                <br>
                                <p style="color: #000;">{{data['content']}}</p>
                                <br>
                                <template v-for="(data2,index2) in commentList">
                                    <div class="replay" v-if="data2 != commentList['allcount'] &&  data2['parent_id'] == data['id']">
                                        <p style="color: #000;"><span >{{data2['owner']['username']}}&nbsp;评论&nbsp;{{data['owner']['username']}}：</span>&nbsp;{{data2['content']}}</p>
                                    </div>
                                    <br>
                                </template>
                            </div>
                            <br>
                            <hr/>
                        </div>
                    </template>
                </div>
        </div>
        <div style="margin-bottom: 54px;"></div>
        <div class="form-group cominput"  id="comment" hidden>
            <input type="text"  class="form-control" placeholder="请输入评论内容" v-model="content"  style="width:80%;display: inline-block;padding-left: 10px;"  onblur="hide()"  required/>
            <button type="button" class="btn btn-success btn-lg" style="padding:5px;display: inline-block" @click="send()">&nbsp;发送&nbsp;</button>
        </div>
        <div class="form-group cominput"  id="comson" hidden>
            <input type="text"  class="form-control" placeholder="请输入评论内容" v-model="content"  style="width:80%;display: inline-block;padding-left: 10px;"  onblur="hide()" required/>
            <button type="button" class="btn btn-success btn-lg" style="padding:5px;display: inline-block" @click="sonsend()">&nbsp;发送&nbsp;</button>
        </div>
        <div class="icon">
            <div class="icon1">
                <a href="javascript:">
                    <p><i class="fa fa-share"></i>&nbsp;&nbsp;转发</p>
                </a>
            </div>
            <div class="icon1">
                <a href="javascript:">
                    <p  @click="comment()"><i class="fa fa-commenting-o"></i>&nbsp;&nbsp;评论</p>
                </a>
            </div>
            <div class="icon1">
                <a href="javascript:">
                    <p ><i class="fa fa-heart-o" ref="zan"   style="color: rgb(254, 112, 112);"></i>&nbsp;&nbsp;&nbsp;点赞</p>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
    import { Button,Toast,MessageBox} from 'mint-ui';
    import Refresh from '@/components/Refresh';
    export default {
        name: 'Postsdetail',
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
                if(this.userInfo['gender'] == '2'){
                    this.img = 'static/images/woman.png';
                }
                this.getPosts();
            }

            // 调用获取评论数据的方法
            this.getComments();
        },
        data () {
            return {
                userInfo:[],
                postlist:[],
                img:'static/images/man.jpg',
                content:'',
                postsId:'',
                commentList:[],
                comId:''
            }
        },
        computed: {

        },
        methods:{
            goBack() {
                // 点击后退
                this.$router.go(-1);
            },
            // 获取当前动态数据
            getPosts() {
                this.postsId = this.$route.params.postid;
                if (this.postsId !== '') {
                    //TODO: 设置loading状态
                    this.$store.commit('showLoading')
                    this.axios.get('http://120.79.74.212/api/posts/' + this.postsId  + '/detail').then((response) => {
                        if (response.status != 200 && response.data.code != 500) {
                            Toast('操作有误,请稍后再试！');
                        } else if (response.status == 200 && response.data.code == '500') {
                            Toast('获取动态数据失败,请稍后再试！');
                        } else {
                            this.postlist = response.data.data;
                            // console.log(this.postlist);
                            for (let obj of this.postlist) {
                                if (obj.files === null) {
                                    this.refresh();
                                } else {
                                    let files = obj.files.split('&');
                                    // 删除数组的最后一个空元素
                                    files.splice(files.length - 1, 1);
                                    obj.files = files;
                                }
                            }
                        }
                        this.$store.commit('hideLoading')
                    })
                }
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
                                this.$router.go(-1);
                            }
                        })
                    }
                }).catch(err => {
                    if (err == 'cancel') {     //取消的回调
                    }
                });
            },
            // 刷新当前路由
            refresh(){
                this.$router.replace({
                    path: '/postsdetail/'+this.postsId+'/',
                    query: {
                        t: Date.now()
                    }
                });
            },
            // 发送评论内容
            send(){
                if(this.content == ''){
                    Toast('评论内容必须填写！');
                }
                else{
                    let params = {content: ''};
                    params.content = this.content;
                    // 请求评论数据接口
                    this.axios.post('http://120.79.74.212/api/posts/'+this.postsId+'/'+this.userInfo.id+'/comments',params).then((response) =>{
                        if(response.status != 200 && response.data.code != 500){
                            Toast('操作失败,请稍后再试！');
                        }
                        else if(response.status == 200 && response.data.code == 500){
                            Toast('获取评论数据失败,请稍后再试！');
                        }
                        else{
                            $('#comment').hide();
                            Toast('评论成功！');
                            this.getComments();
                            this.refresh();
                        }
                    })
                }
            },
            hide(){
                $('#comment').hide();
                $('#comson').hide();
            },
            // 弹出评论面板
            comment(){
                // 经测试，弹出来的面板会被输入面板顶上去
                $('#comment').show();
            },
            // 获取根评论以及其对应子评论
            getComments(){
                if(this.postsId != ''){
                    //TODO: 设置loading状态
                    this.$store.commit('showLoading')
                    this.axios.get('http://120.79.74.212/api/posts/' + this.postsId + '/getComments').then((response) => {
                        if (response.status != 200 && response.data.code != 500) {
                            Toast('操作有误,请稍后再试！');
                        } else if (response.status == 200 && response.data.code == '500') {
                            Toast('获取评论数据失败,请稍后再试！');
                        } else {
                            this.commentList = response.data.data;
                            // console.log(this.commentList);
                        }
                        this.$store.commit('hideLoading')
                    })
                }
            },
            // 子评论
            comson(comId){
                 this.comId = comId;
                 $('#comson').show();
            },
            // 子评论提交
            sonsend(){
                if(this.content == ''){
                    Toast('评论内容必须填写！');
                }
                else{
                    let params = {content: '',parent_id:0};
                    params.content = this.content;
                    params.parent_id = this.comId;
                    // 请求评论数据接口
                    this.axios.post('http://120.79.74.212/api/posts/'+this.postsId+'/'+this.userInfo.id+'/comments',params).then((response) =>{
                        if(response.status != 200 && response.data.code != 500){
                            Toast('操作失败,请稍后再试！');
                        }
                        else if(response.status == 200 && response.data.code == 500){
                            Toast('获取评论数据失败,请稍后再试！');
                        }
                        else{
                            $('#comson').hide();
                            Toast('评论成功！');
                            this.getComments();
                            this.refresh();
                        }
                    })
                }
            }
        }
    }
</script>
<style scoped>
    @import '../../static/css/postsdetail.css'
</style>


