# TianApp

#### 这是混合APP是本人的毕业设计作品

#### 使用前后端分离技术，后端技术栈为（Laravel5.6+mysql+Vue），后端放在了阿里云的宝塔面板上，主要为APP端提供接口数据和方便管理员管理

#### 前端APP技术栈为（Vue.js 2.0 + axios + Mint-ui + mui+ Vuex + router + webpack ） 为了方便操作，我把前端项目跟后端项目放在一起，就是 webapp整个文件夹

#### 实现功能

## 后端
1.实现了后台管理员的RBAC等级权限限制，由超级管理员授予创建角色，并授予相应的管理权限

2.实现了Laravel+Vue 进行多视频上传至七牛云服务器

3.实现了课程的标签管理、视频评论管理、APP会员动态管理和图书管理

## APP端
1. 实现了课程的视频的播放与下载，课程简介、章节显示和视频评论

2.实现了类似盆友圈的功能，可上传图片和视频，在手机上可以进行相机拍照上传

3.实现了动态点赞

4.实现了动态的无限级评论回复

5.使用了Vuex记录了购物车的实时变化

#### Todo
1.动态转发功能

2.支付功能(想做个支付宝测试沙箱功能)

#### 效果展示



## 后台
![Image text](http://111.230.131.146/show/01.png)



#### 使用说明


#### 后端Laravel项目安装教程

1. 先安装composer和php运行环境
2. 克隆项目 运行   
git clone https://github.com/111Quentin/TianApp.git
3. 安装依赖
composer install 
4.创建你的配置文件
cp .env.example .env
5.编辑其中的数据库部分

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tianapp
DB_USERNAME=tianapp
DB_PASSWORD=tianapp

6.同步数据库结构

php artisan migrate

7.生成你的密钥

php artisan key:generate

#### 前端APP项目安装教程
1. 切换到APP目录
cd  ./webapp

2. 安装依赖
npm install

3.运行项目
npm run dev 

4.打包项目
npm run build


5. 线上地址
http://111.230.131.146




