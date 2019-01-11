<?php
namespace app\maker\controller;

use think\Controller;

class BaseController extends Controller{
    
    public function __construct(){
        if (! is_police_login()) {
            return $this->error('你还没有登陆！', '@user/Login');
        }
        
        parent::__construct();
    }
}