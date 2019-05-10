import axios from 'axios';

let base = 'http://120.79.74.212';   // 根域名

//用户注册请求接口
export const requestRegister = params => {
    return axios.post(`${base}/api/member/register`, params).then(res => {
        return res.data;
    }, err => {
        console.log(err);
    }).catch((error) => {
        console.log(error)
    });
};

//用户登录请求接口
export const requestLogin = params => {
    return axios.post(`${base}/api/member/login`, params).then(res => {
        return res.data;
    }, err => {
        console.log(err);
    }).catch((error) => {
        console.log(error)
    });
};

//会员编辑请求接口
export const requestEdit = params => {
    return axios.post(`${base}/api/member/edit`, params).then(res => {
        return res.data;
    }, err => {
        console.log(err);
    }).catch((error) => {
        console.log(error)
    });
};

//上传文章文件请求接口
export const requestUpload = params => {
    return axios.post(`${base}/api/posts/uploader/qiniu`, params).then(res => {
        return res.data;
    }, err => {
        console.log(err);
    }).catch((error) => {
        console.log(error)
    });
};



