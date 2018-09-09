<?php
use think\Container;
use think\facade\Request;
// 加载基础文件
require __DIR__ . '/thinkphp/base.php';

define('__ROOT__', Request::rootUrl() . '/');

// 支持事先使用静态方法设置Request对象和Config对象

// 执行应用并响应
// Container::get('app')->path(__DIR__ . '/application/')->initialize();