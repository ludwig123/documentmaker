<?php
namespace app\user\controller;

use think\Controller;

class Reg extends Controller
{
    public function index(){
        return $this->fetch();
    }
}

