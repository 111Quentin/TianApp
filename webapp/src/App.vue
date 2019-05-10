<template>
  <div id="app">
    <!-- 中间的 路由 router-view 区域 -->
    <transition>
      <router-view></router-view>
    </transition>
      <loading v-if="LOADING"></loading>
  </div>
</template>

<script>
  import loading  from "@/components/Loading"
  import {mapState} from 'vuex'
 export default {
      components:{
        loading
      },
      computed:{
        // ...mapState([
        //   'LOADING'
        // ])
        LOADING:function () {
            // console.log(this.$store.state.LOADING);
            return this.$store.state.LOADING;
        }
      },
  name: 'App'
}
</script>

<style scoped>
      #app {
      font-family: 'Avenir', Helvetica, Arial, sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      text-align: center;
      color: #2c3e50;
      }

      * {
      padding: 0;
      margin: 0;
      }

      li {
      list-style: none;
      }

      body {
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      padding-bottom: 15%;
      }
</style>
