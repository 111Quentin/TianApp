// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
// 引入轮播图插件
import VueAwesomeSwiper from 'vue-awesome-swiper'
import axios from 'axios'
import Vuex from 'vuex'
import VueAxios from 'vue-axios'
// 引入mint-UI(全局引入mint-UI)
import MintUI from 'mint-ui'
import 'mint-ui/lib/style.css'
// 导入格式化时间的插件
import moment from 'moment'
// 引入vuex实例
import store from  './vuex/store'



Vue.config.productionTip = false
// 使用轮播图插件
Vue.use(VueAwesomeSwiper)
// 将VueAxios注册到项目中
Vue.use(VueAxios, axios)
// 使用MintUI
Vue.use(MintUI)
// 使用Vuex
Vue.use(Vuex)

// 引入mui
// import '../static/lib/mui/dist/css/mui.min.css'


// 定义全局的过滤器
Vue.filter('dateFormat', function (dataStr, pattern = "YYYY-MM-DD HH:mm:ss") {
  return moment(dataStr).format(pattern)
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})

/*默认跳转到组件顶端*/
router.afterEach((to,from,next) => {

  window.scrollTo(0,0);

})
