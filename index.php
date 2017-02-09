<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/application/');
define('PUBLIC_PATH', __DIR__ . '/public/');
define('UPLOAD_PATH', __DIR__ . '/public/uploads/');

define('SITE_URL','http://localhost/Thinkphp');

// 定义缓存目录
define('RUNTIME_PATH',__DIR__.'/Runtime/');
// 定义模板文件默认目录
define("TMPL_PATH",__DIR__."/tpl/");

// if (!file_exists(APP_PATH.'systemConfig.php')) {
//     header("Location: install/");
//     exit;
// }

// 加载框架引导文件
require __DIR__ . '/thinkphp/start.php';