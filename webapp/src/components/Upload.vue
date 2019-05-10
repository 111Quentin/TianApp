<template>
    <div id="bg">
        <div class="title">
            <router-link to="/myposts" class="left">
                <span><i class="fa fa-close"></i></span>
            </router-link>
            <h3 style="padding-top: 19px;margin-right: 30px;">发布动态</h3>
            <a href="javaScript:" class="right" @click="postArticle()">
                <h3 style="margin-top: -26px;margin-right: 13px;">发送</h3>
            </a>
        </div>
        <div class="clear"></div>
        <div class="content">
            <textarea name="content" cols="30" rows="10" placeholder="记录一下今天的美好经历吧！" maxlength="240" v-model="content"></textarea>
            <div class="maxlength">
                <p>最多240字</p>
            </div>
            <div class="clear"></div>
            <!-- 文件上传 -->
                <!--<div class="upload" id="filePicker">-->
                    <!--<div id="fileList" class="uploader-list"></div>-->
                    <!--<div class="wpr pic-list"  ref="picFile"></div>-->
                    <!--<span class="pic-upload"  id="imgPicker"></span>-->
                    <!--<br>-->
                    <!--<p class="c3">图片最多可上传9张</p>-->
                <!--</div>-->
        </div>

        <div class="page">
            <div id="filePicker">选择文件</div>
            <div class="file-panel">
                <h2 align="left">文件列表</h2>
                <div class="file-list">
                    <ul class="file-item" :class="`file-${file.id}`" v-for="file in fileList">
                        <li class="file-type" :icon="fileCategory(file.ext)"></li>
                        <li class="file-name">{{file.name}}</li>
                        <li class="file-size">{{fileSize(file.size)}}</li>
                        <li class="file-status">上传中...</li>
                        <li class="file-operate">
                            <a title="开始" @click="resume(file)"><i class="fa fa-play-circle-o"></i></a>
                            <a title="暂停" @click="stop(file)"><i class="fa fa-pause-circle-o"></i></a>
                            <a title="移除" @click="remove(file)"><i class="fa fa-close"></i></a>
                        </li>
                        <li class="progress"></li>
                    </ul>
                    <div class="no-file" v-if="!fileList.length"><i class="iconfont icon-empty-file"></i> 暂无待上传文件</div>
                </div>
            </div>

            <VueUploader
                    ref="uploader"
                    uploadButton="#filePicker"
                    multiple
                    @fileChange="fileChange"
                    @progress="onProgress"
                    @success="onSuccess"
            ></VueUploader>
        </div>

    </div>
</template>
<script>
    import { Toast } from 'mint-ui';
    import VueUploader from '@/components/VueUploader';
    import Refresh from '@/components/Refresh';
    import Redirect from '@/components/Redirect';
    import  { requestUpload } from "../api/api";
    let  params = {content:'',files:[],member_id: ''}
    export default {
        name: 'Upload',
        components:{
            VueUploader
        },
        data () {
            return {
                content:'',
                fileList: [],
                userInfo:[],
            }
        },
        mounted() {
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
        computed: {
            uploader() {
                return this.$refs.uploader;
            }
        },
        methods:{
            goBack() {
                // 点击后退
                this.$router.go(-1);
            },
            fileChange(file) {
                if (!file.size) return;
                this.fileList.push(file);
                // console.log(file);
            },
            onProgress(file, percent) {
                $(`.file-${file.id} .progress`).css('width', percent * 100 + '%');
                $(`.file-${file.id} .file-status`).html((percent * 100).toFixed(2) + '%');
            },
            onSuccess (file, response) {
                // console.log('上传成功', response);
                params.files = params.files.concat(response.path);
                requestUpload(data).then(res => {
                        let $fileStatus = $(`.file-${file.id} .file-status`);
                        // console.log(res);
                        if (res.status === 0) {
                            $fileStatus.html('上传成功，转码中');
                        } else if (res.status === 1) {
                            $fileStatus.html('上传失败');
                        } else if (res.status === 2) {
                            $fileStatus.html('上传成功');
                        }
                    });
            },
            resume(file) {
                this.uploader.upload(file);
            },
            stop(file) {
                this.uploader.stop(file);
            },
            remove(file) {
                // 取消并中断文件上传
                this.uploader.cancelFile(file);
                // 在队列中移除文件
                this.uploader.removeFile(file, true);
                // 在ui上移除
                let index = this.fileList.findIndex(ele => ele.id === file.id);
                this.fileList.splice(index, 1);
                // 删除files数组对应的文件路径
                params.files.splice(index,1);
            },
            fileSize(size) {
                return WebUploader.Base.formatSize(size);
            },
            fileCategory(ext) {
                let type = '';
                const typeMap = {
                    image: ['gif', 'jpg', 'jpeg', 'png', 'bmp', 'webp'],
                    video: ['mp4', 'm3u8', 'rmvb', 'avi', 'swf', '3gp', 'mkv', 'flv'],
                    text: ['doc', 'txt', 'docx', 'pages', 'epub', 'pdf', 'numbers', 'csv', 'xls', 'xlsx', 'keynote', 'ppt', 'pptx']
                };
                Object.keys(typeMap).forEach((_type) => {
                    const extensions = typeMap[_type];
                    if (extensions.indexOf(ext) > -1) {
                        type = _type
                    }
                });
                return type
            },
            // 上传文章的方法
            postArticle(){
                // 检查文章是否为空
                if(this.content == ''){
                    Toast({
                        message: '必须填写动态内容哦！',
                        iconClass: 'icon icon-error'
                    });
                }
                else{
                    params.content = this.content;
                    params.member_id = this.userInfo.id;
                    //TODO: 设置loading状态
                    this.$store.commit('showLoading')
                    // 请求上传文章接口
                    this.axios.post('http://120.79.74.212/api/posts/'+this.userInfo.id+'/create',params).then((response) =>{
                        if(response.status != 200 && response.data.code != 200){
                            Toast('发布动态失败,请稍后再试！');
                        }
                        else{
                            params.files = []; // 发布动态成功后就删除上传的文件
                            this.$router.replace('/myposts');
                            this.$store.commit('hideLoading')
                        }
                    })
                }
            }
        }
    }
</script>
<style scoped>
    @import '../../static/css/upload.css'
</style>
<style  lang="scss">
    $h-row: 50px;
    .file-panel {
        width: 100%;
        margin-top: 10px;
        box-shadow: 0 2px 12px 1px rgba(0, 0, 0, 0.1);
        > h2 {
            height: 40px;
            line-height: 40px;
            padding: 0 10px;
            border-radius: 4px 4px 0 0;
            border-bottom: 1px solid #ccc;
            background-color: #fff;
            font-size: 17px;
        }
        .file-list {
            position: relative;
            height: 360px;
            overflow-y: auto;
            background-color: rgb(250, 250, 250);
        }
        .file-item {
            position: relative;
            height: $h-row;
            line-height: $h-row;
            padding: 0 10px;
            border-bottom: 1px solid #ccc;
            background-color: #fff;
            z-index: 1;
            > li {
                display: inline-block;
            }
        }
        .file-type {
            width: 24px;
            height: 24px;
            vertical-align: -5px;
        }
        .file-name {
            width: 40%;
            margin-left: 10px;
        }
        .file-size {
            width: 20%;
        }
        .file-status {
            width: 20%;
        }
        .file-operate {
            width: 40%;
            > a {
                padding: 10px 5px;
                cursor: pointer;
                color: #666;
                position: relative;
                right: 152px;
                bottom: 49px;
                font-size: 18px;
                &:hover {
                    color: #ff4081;
                }
            }
        }
        .progress {
            position: absolute;
            top: 0;
            left: 0;
            height: $h-row - 1;
            width: 0;
            background-color: #E2EDFE;
            z-index: -1;
        }
        .no-file {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 16px;
        }
    }
</style>

