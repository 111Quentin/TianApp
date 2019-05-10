<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  //引入config目录下的app.php的DB门脸类
class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //数据库填充
        //产生faker实例
        $faker = \Faker\Factory::create('zh_CN'); //引入faker类
        // 循环生成数据
        $data = [];
        for($i =0 ;$i < 20;$i++){
            $data[] = [
              'username'    => $faker -> userName,  //生成用户名
              'password'    => bcrypt('123456'),    //使用框架内置bcrypt方法进行加密
              'gender'      => rand(1,3),
              'mobile'      => $faker -> phoneNumber,
              'email'       => $faker -> email,
              'role_id'     => rand(1,6),
              'created_at'  => date('Y-m-d H:i:s',time()),
              'status'      => rand(1,2) //账号状态
            ];
        }

        DB::table('manager')->insert($data);
    }
}
