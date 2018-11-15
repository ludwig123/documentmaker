<?php
namespace app\maker\controller;

use think\Controller;
use think\Db;
use app\maker\model\Code;
use app\maker\model\Record;
use app\maker\model\TrafficCase;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
class Page extends Controller
{
    public function info(){
        
            $this->assign([
                'id'  => $id
            ]);
            return $this->fetch("form");
        
    }
    
    
}