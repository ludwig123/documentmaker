<?php
namespace app\index\controller;

use \think\Controller;
class Index extends Controller
{
    public function index()
    {
        $data = array();
        
        $res = empty($data['sd']);
    
        return $this->fetch('index');
    }

    public function hello($name = 'ThinkPHP5')
    {
    
    }

}
