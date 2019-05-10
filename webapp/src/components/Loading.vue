<template>
    <transition :name="animateName">
        <div class="loadings">
            <div class="loadings__loader">
                <div class="loadings__loader__dot"></div>
                <div class="loadings__loader__dot"></div>
                <div class="loadings__loader__dot"></div>
                <div class="loadings__loader__dot"></div>
            </div>
        </div>
    </transition>
</template>
<script type="text/babel">

    export default {
        name:'Loading',
        data() {
            return {
                isShow: true,
                hasAnimate: true,
            }
        },
        computed: {
            /**
             * 动画效果样式，没有返回空
             * @return {String} 样式
             */
            animateName() {
                return this.hasAnimate ? 'opacity' : ''
            },
        },
        methods: {
            /**
             * 开启动画效果
             */
            opemAnimate() {
                this.hasAnimate = true
            },
            /**
             * 去除动画效果
             * @return {Promise} 返回promise
             */
            removeAnimate() {
                return new Promise((resolve) => {
                    this.hasAnimate = false
                    resolve()
                })
            },
            // /**
            //  * 显示动画loading
            //  */
            // show() {
            //     this.isShow = true
            // },
            // /**
            //  * 隐藏动画loading
            //  */
            // hide() {
            //     this.isShow = false
            // },
        },
    }
</script>

<style   scope>
    .loadings {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: transparent;
    }
    .loadings__loader {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate3d(-50%, -50%, 0);
    }
    .loadings__loader__dot {
        width: 30px;
        height: 30px;
        background: #3ac;
        border-radius: 100%;
        display: inline-block;
        animation: slide 1s infinite;
        margin-right: 6px;
    }
    .loadings__loader__dot:nth-child(1) {
        animation-delay: 0.3s;
        background: #dc3535;
    }
    .loadings__loader__dot:nth-child(2) {
        animation-delay: 0.4s;
        background: #e04f4f;
    }
    .loadings__loader__dot:nth-child(3) {
        animation-delay: 0.5s;
        background: #e56969;
    }
    .loadings__loader__dot:nth-child(4) {
        animation-delay: 0.6s;
        background: #e98383;
    }
    .loadings__loader__dot:nth-child(5) {
        animation-delay: 0.7s;
        background: #ee9d9d;
    }
    .opacity-enter-active,
    .opacity-leave-active {
        transition: all 0.6s;
    }
    .opacity-enter,
    .opacity-leave-active {
        opacity: 0;
    }
    @-moz-keyframes slide {
        0% {
            transform: scale(1);
        }
        50% {
            opacity: 0.3;
            transform: scale(2);
        }
        100% {
            transform: scale(1);
        }
    }
    @-webkit-keyframes slide {
        0% {
            transform: scale(1);
        }
        50% {
            opacity: 0.3;
            transform: scale(2);
        }
        100% {
            transform: scale(1);
        }
    }
    @-o-keyframes slide {
        0% {
            transform: scale(1);
        }
        50% {
            opacity: 0.3;
            transform: scale(2);
        }
        100% {
            transform: scale(1);
        }
    }
    @keyframes slide {
        0% {
            transform: scale(1);
        }
        50% {
            opacity: 0.3;
            transform: scale(2);
        }
        100% {
            transform: scale(1);
        }
    }

</style>