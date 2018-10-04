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
    
    /**查获经过
     * @return mixed|string
     */
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
    
    /**告知笔录
     * @return mixed|string
     */
    public function gaozhibilu($index){
        $record = (new Record())->getRecordByIndex($index);
        
        $this->assign([
            'zhidui'=>$record->record(),
            'dadui'=>'衡阳西',
            'code_1_content'=>'没带驾驶证', 
            'code_1_against'=>'违反的法律',
            'code_1_punish'=>'处罚的依据',
            'code_1_money'=>'200',
            'code_2_content'=>'没带驾驶证2',
            'code_2_against'=>'违反的法律2',
            'code_2_punish'=>'处罚的依据2',
            'code_2_money'=>'100',
            'name'  => '刘少乃',
            'time' => '2018年04月07日11时15分',
            'place'=>'泉南高速',
            'evidence'=>'陈述和沈变',
            'car' =>'湘D',
            'car_type' =>'小轿车',
            
            
            
        ]);
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
