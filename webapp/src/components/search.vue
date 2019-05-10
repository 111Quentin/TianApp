<template>
    <div class="wrapper">
        <div class="search">
            <div class="searchbar">
                <i class="mintui mintui-search center"></i>
                <form action="" class="form">
                    <input ref="input"
                           @click="visible = true"
                           type="search"
                           v-model="currentValue"
                           :placeholder="placeholder"
                           class="input"
                    >
                </form>
            </div>
            <a class="back" @click="back" v-show="isSearching">取消</a>
        </div>

        <div class="content" v-if="isShowContent">
            <li class="result" v-for="item in result" :key="item.id">
                <mt-cell :title="item.title"  is-link  >
                </mt-cell>
            </li>
            <div class="notfound" v-if="!result.length">
                <br>
                <h1>待开发</h1>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        props: {
            isSearching: {
                type: Boolean,
                default: true
            }
        },
        data() {
            return {
                currentValue: null,
                visible: false,
                placeholder: "搜索我感兴趣的内容",
                allClass: [],
                result: [],
                isShowContent: false
            };
        },
        methods: {
            back() {
                this.$router.go("-1");
            },
            // change(event) {
            //     this.result = this.allClass.filter(item => {
            //         if (item.title.indexOf(event.target.value) >= 0) {
            //             return item;
            //         }
            //     });
            // }
        },
        mounted() {
            if (this.$route.path == "/search") {
                this.isShowContent = true;
            }
            else this.isShowContent = false;
        }
    };
</script>

<style  scoped>
  .wrapper{
      margin-top: 20px;
      margin-bottom: 22px;
  }

   .searchbar{
      height: 35px;
   }
    .wrapper .search {
        height: 1.28rem;
        width: 95%;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fff;
    }
    .wrapper .search .searchbar {
        background-color: #f2f4f7;
        flex: 9;
        margin: 0.28444rem;
        border-radius: 1.42666rem;
    }
    .wrapper .search .searchbar .mintui-search {
        line-height: 0.71111rem;
        margin-left: 0.28444rem;
    }
    .wrapper .search .searchbar .form {
        display: inline;
    }
    .wrapper .search .searchbar .form .input {
        background-color: #f2f4f7;
        width: 85%;
        /*height: 0.83222rem;*/
        border: 0;
        outline: none;
    }
    .wrapper .search .back {
        text-align: center;
        flex: 1;
    }
    .wrapper .search .back:active {
        background-color: #f2f4f7;
    }
    .wrapper .content .result {
        list-style-type: none;
    }
    .wrapper .content .result .mint-cell-wrapper {
        font-size: 0.3rem;
    }
    .wrapper .content .notfound {
        text-align: center;
    }

    .wrapper a{
        color: black;
        text-decoration: none;
        margin-left: 5px;
    }
  .wrapper h1{
      display: block;
      font-size: 2em;
      margin-block-start: 0.67em;
      margin-block-end: 0.67em;
      margin-inline-start: 0px;
      margin-inline-end: 0px;
      font-weight: bold;
      color: black;
  }
</style>

<style>
  .center{
      line-height: 2.71111rem !important;
      margin-left: 0.88444rem !important;
  }
</style>
