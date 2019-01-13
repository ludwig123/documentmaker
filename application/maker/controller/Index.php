<?php
namespace app\maker\controller;

use think\Controller;
use think\Db;
use app\maker\model\Code;
use app\maker\model\Record;
use app\maker\model\TrafficCase;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
class Index extends Controller
{


    //查获经过
    
    //主页面，录入驾驶人信息等等
    public function form($id = ""){
        //在页面注入案件的ID
        $this->assign([
            'id'  => $id
        ]);
        return $this->fetch("form");
    }
    
    public function mydoc(){
        return $this->fetch('mydoc');
    }

    public function code(){
        return $this->fetch('code');
    }
    
    public function recordslist(){
        return $this->fetch('recordslist');
    }
    
   
    
}
