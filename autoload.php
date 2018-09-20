<?php
// 加载基础文件
echo "import base.php";
use think\Console;
use think\Container;
use think\Facade\Request;

echo "next import base.php";
require __DIR__ . '/thinkphp/base.php';
echo "import base.php";
 define('__ROOT__', Request::rootUrl() . '/');
// 应用初始化
Container::get('app')->path(__DIR__ . '/application/')->initialize();
