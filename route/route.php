<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});
// 当用户访问 xxx.com/hello/xxx ,找到 Index控制器中的hello方法
Route::get('hello/:name', 'index/hello');
Route::get('login', 'index/login');  //用户登录
Route::get('user/:reg', 'index/reg');//用户注册
Route::get('goods/:list', 'index/goodsList');//商品列表


return [

];
