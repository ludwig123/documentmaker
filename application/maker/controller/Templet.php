<?php
namespace app\maker\controller;

use think\Controller;


class Templet extends Controller
{
    public function editor(){
       return $this->fetch();
    }
}