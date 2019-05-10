<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //指定数据表
    protected  $table = 'goods';
    // 指定填充字段
    protected  $fillable = ['goods_sn','goods_nums','market_price','shop_price','goods_img'];
}
