<?php
namespace app\maker\controller;

use think\Controller;
use app\maker\model\Record;
use app\maker\model\TrafficCase;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
class Index extends Controller
{
    public function index() 
    {
        $name = "刘哲";
        $this->assign('name',$name);
        return $this->fetch();
    }

    //查获经过
    
    //主页面，录入驾驶人信息等等
    public function form(){
//         $trafficCase = new TrafficCase();
//         $case = $trafficCase->getDecisionNum();
        return $this->fetch("form");
    }
    
    public function shenpibiao(){
        return $this->fetch("shenpibiao");
    }
    
    public function chahuojingguo(){
        $list = Record::get(1);
               
        $result = 0;
        $this->assign([
            'name'  => '刘少乃',
            'caughtTime' => '2018年04月07日11时15分'
        ]);
        
        
        return $this->fetch('chahuojingguo');
    }
    
    public function footer(){
       return $this->fetch('maker@common/footer');
    }
    
    public function gaozhibilu(){
        return $this->fetch('gaozhibilu');
    }
    
    public function juedingshu(){
        return $this->fetch('juedingshu');
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
