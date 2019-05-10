<template>
    <div>
        <ul id="list">
            <li v-for="v in videos">
                <a href="javascipt:" @click.prevent="play(v)">{{v.title}}</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name:'catalog',
        props:{
            current:'',
            videos:''
        },
        methods:{
            // 播放视频方法
            play(video){
                // console.log(this.videos);
                // console.log(this.current);
                // this.current = video;
                // 子组件向父组件传值(将当前视频索引传给父组件)
                this.$emit('childByValue', video)
            }
        }
    }
</script>

<style scoped>
    @import '../../static/css/catalog.css'
</style>