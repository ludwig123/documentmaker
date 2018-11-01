<?php
namespace app\index\controller;

use \think\Controller;
class Index extends Controller
{
    public function index()
    {
        $test = array(
            'id'=>'123',
            'des'=>'蝙蝠侠',
            'des2'=>'蝙蝠侠哈
哈哈'
        );
        $str = json_encode($test);
        var_dump($str);
        $this->assign('test', $str);
    
        return $this->fetch('index');
    }

    public function hello($name = 'ThinkPHP5')
    {
    
    }

}
