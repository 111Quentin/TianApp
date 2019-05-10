import Vue from 'vue'
import Router from 'vue-router'

import Home from '@/components/Home'
import Video from '@/components/Video'
import Page from '@/components/Page'
import User from '@/components/User'
import Login from '@/components/Login'
import Register from '@/components/Register'
import Usercenter from '@/components/Usercenter'
import Edituser  from '@/components/Edituser'
import Setting from '@/components/Setting'
import Aboutus  from '@/components/Aboutus'
import search  from '@/components/search'
import Loading  from '@/components/Loading'
import Upload  from '@/components/Upload'
import VueUploader  from '@/components/VueUploader'
import Refresh  from '@/components/Refresh'
import Redirect  from '@/components/Redirect'
import Myposts  from '@/components/Myposts'
import Allposts  from '@/components/Allposts'
import Postsdetail  from '@/components/Postsdetail'
import Books  from '@/components/Books'
import Swiper  from '@/components/Swiper'
import Booksdetail  from '@/components/Booksdetail'
import Books_numbox  from '@/components/Books_numbox'
import Shopcart  from '@/components/Shopcart'
import Shopcart_numbox  from '@/components/Shopcart_numbox'
Vue.use(Router)
export default new Router({
  routes: [
        //  配置路由规则
        { path:'/',redirect:'/home'},
        { path: '/home', name: 'Home', component: Home },
        // 这里的?是正则表达式的问号,表示0个或1个
        { path: '/video/:tid?', name: 'Video', component: Video },
        {
              path: '/page/:lessonId',
              name: 'Page',
              component: Page,
              // children:[
              //   {
              //     path: '',
              //     redirect: 'introduce'
              //   },
              //   { path: 'introduce', component: introduce, name: 'introduce' },
              //   { path: 'catalog', component: catalog, name: 'catalog' },
              //   { path: 'comment', component:comment, name: 'comment' },
              // ]
        },
        { path:'/user', name:'User', component: User },
        { path:'/login', name:'Login', component:Login},
        { path:'/register', name:'Register', component:Register},
        { path:'/usercenter',name:'Usercenter',component:Usercenter},
        { path:'/edituser',name:'Edituser',component:Edituser},
        { path:'/setting',name:'Setting',component:Setting},
        { path:'/aboutus',name:'Aboutus',component:Aboutus},
        { path:'/search',name:'search',component:search},
        { path:'/loading',name:'Loading',component:Loading},
        { path:'/myposts',name:'Myposts',component:Myposts},
        { path:'/allposts',name:'Allposts',component:Allposts},
        { path:'/upload',name:'Upload',component:Upload},
        { path:'/postsdetail/:postid',name:'Postsdetail',component:Postsdetail},
        { path:'/books',name:'Books',component:Books},
        { path:'/booksdetail/:bookid',name:'Booksdetail',component:Booksdetail},
        { path:'/shopcart',name:'Shopcart',component:Shopcart},
  ]
})
