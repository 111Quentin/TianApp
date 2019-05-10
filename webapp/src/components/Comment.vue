<template>
    <div class="cmt-container">
        <textarea placeholder="请输入要BB的内容（做多吐槽120字）" maxlength="120" v-model="content"></textarea>
        <br>
        <mt-button type="primary" size="large" @click="postComments()">发表评论</mt-button>
        <div class="cmt-list">
            <div class="cmt-item"  v-for="(item,i) in comments" :key="item.id">
                <div class="cmt-title">
                    第{{ i+1 }}楼&nbsp;&nbsp;用户：{{ item.member_name }}&nbsp;&nbsp;发表时间：{{ item.created_at | dateFormat }}
                </div>
                <div class="cmt-body">
                    {{ item.content === 'undefined' ? '此用户很懒，嘛都没说': item.content }}
                </div>
            </div>
        </div>
        <mt-button type="danger" size="large" plain @click="getMore()">加载更多</mt-button>
        <br>
    </div>
</template>

<script>
    import { Toast } from "mint-ui";
    export default {
        name:'comment',
        props:{
            videoId:'',
            videos:''
        },
        data(){
            return{
                 pageIndex: 1, // 默认显示第一页的数据
                 comments:[], // 所有的评论的数据
                 content:"",
                 flag:false   // 切换标记
            }
        },
        watch:{
              videoId(newValue,oldValue){
                  // console.log(newValue);
                  this.videoId = newValue;
                  this.flag = false;  // 表示切换了video_id
                  this.getComments();
              }
        },
        methods:{
              // 定义获取评论数据的方法
              getComments(){
                  this.axios.get('http://120.79.74.212/api/member/getcomments/' + this.videoId+ "?pageIndex=" + this.pageIndex).then((response) => {
                      if(response.status != 200 && response.data.code != 200){
                          Toast('获取评论失败,请稍后再试！');
                      }
                      else{
                           if(this.flag){
                               this.comments = this.comments.concat(response.data.data);
                           }
                           else {
                               this.comments = response.data.data;
                           }
                      }
                  })
              },

            // 加载更多
            getMore(){
                this.pageIndex++;
                this.flag = true; // 表示获取下一页
                this.getComments();
            },
            // 定义提交评论数据的方法
            postComments(){
                // 验证是否登录,没有就跳转到登录页
                let userInfo = JSON.parse(window.localStorage.getItem('userInfo'));  // 将localStorage的值转换成对象
                if(!userInfo){
                    Toast({
                        message: '请先登录！',
                        iconClass: 'icon icon-error'
                    });
                    this.$router.replace("/login");
                }

                // 判断提交评论内容是否为空
                if (this.content.trim().length === 0) {
                    return Toast("评论内容不能为空！");
                }

                // 将相关信息存入存入对象
                let data = {
                    content: this.content,
                    member_id:userInfo.id,
                    member_name: userInfo.username
                };
                // 将相关信息发送给提交评论接口
                this.axios.post('http://120.79.74.212/api/member/postcomment/' + this.videoId,data).then((response) => {
                    if(response.status != 200 && response.data.code != 200){
                        Toast('评论失败,请稍后再试！');
                    }
                    else{
                        // this.comments = response.data.data;
                        // console.log(response.data.data);
                        Toast({
                            message: '评论成功',
                            iconClass: 'icon icon-success'
                        });
                        // 刷新当前页面
                        this.getComments();
                    }
                })
            }
        }
    }
</script>

<style scoped>
    @import '../../static/css/comment.css'
</style>