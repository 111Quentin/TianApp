import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
var car = JSON.parse(localStorage.getItem('car') || '[]');
 const store = new Vuex.Store({
    state: {
        // this.$store.state.***
        LOADING: false,
        car: car // 将 购物车中的商品的数据，用一个数组存储起来，在 car 数组中，存储一些商品的对象， 咱们可以暂时将这个商品对象，设计成这个样子
        // { id:商品的id, count: 要购买的数量, price: 商品的单价，selected: false  }
    },
    mutations: {
        // 显示加载效果
        showLoading(state){
            state.LOADING = true
        },
        // 隐藏加载效果
        hideLoading (state) {
            setTimeout(function () {
                state.LOADING = false
            },300)
        },
        addToCar(state, booksinfo) {
            // 点击加入购物车，把商品信息，保存到 store 中的 car 上
            // 分析：
            // 1. 如果购物车中，之前就已经有这个对应的商品了，那么，只需要更新数量
            // 2. 如果没有，则直接把 商品数据，push 到 car 中即可

            // 假设 在购物车中，没有找到对应的商品
            var flag = false
            state.car.some(item => {
                // 如果图书添加购物车之前，发现已有同样商品，只需要增加其数量即可
                if (item.id == booksinfo.id) {
                    item.count += parseInt(booksinfo.count)
                    flag = true
                    return true
                }
            })

            // 如果最终，循环完毕，得到的 flag 还是 false，则把商品数据直接 push 到 购物车中
            if (!flag) {
                state.car.push(booksinfo)
            }

            // 当 更新 car 之后，把 car 数组，存储到 本地的 localStorage 中
            localStorage.setItem('car', JSON.stringify(state.car))
        },
        updateBooksInfo(state, booksinfo) {
            // 修改购物车中商品的数量值
            // 分析：
            state.car.some(item => {
                if (item.id == booksinfo.id) {
                    item.count = parseInt(booksinfo.count)
                    return true
                }
            })
            // 当修改完商品的数量，把最新的购物车数据，保存到 本地存储中
            localStorage.setItem('car', JSON.stringify(state.car))
        },
        removeFormCar(state, id) {
            // 根据Id，从store 中的购物车中删除对应的那条商品数据
            state.car.some((item, i) => {
                if (item.id == id) {
                    state.car.splice(i, 1)
                    return true;
                }
            })
            // 将删除完毕后的，最新的购物车数据，同步到 本地存储中
            localStorage.setItem('car', JSON.stringify(state.car))
        },
        updateBooksSelected(state, info) {
            state.car.some(item => {
                if (item.id == info.id) {
                    item.selected = info.selected
                }
            })
            // 把最新的 所有购物车商品的状态保存到 store 中去
            localStorage.setItem('car', JSON.stringify(state.car))
        }
    },
     getters: { // this.$store.getters.***
         // 相当于 计算属性，也相当于 filters
         getAllCount(state) {
             var c = 0;
             state.car.forEach(item => {
                 c += item.count
             })
             return c
         },
         getBooksCount(state) {
             var o = {}
             state.car.forEach(item => {
                 o[item.id] = item.count
             })
             return o
         },
         getBooksSelected(state) {
             var o = {}
             state.car.forEach(item => {
                 o[item.id] = item.selected
             })
             return o
         },
         getBooksCountAndAmount(state) {
             var o = {
                 count: 0, // 勾选的数量
                 amount: 0 // 勾选的总价
             }
             state.car.forEach(item => {
                 if (item.selected) {
                     o.count += item.count
                     o.amount += item.price * item.count
                 }
             })
             return o
         }

     }

})

export default store

