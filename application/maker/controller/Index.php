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
    public function form($id = ""){
        $this->assign([
            'id'  => $id
        ]);
        return $this->fetch("form");
    }
    
    public function shenpibiao(){
        return $this->fetch("shenpibiao");
    }
    
    /**查获经过
     * @return mixed|string
     */
    public function chahuojingguo(){
        $list = TrafficCase::findById(1);
        if (!empty($list)){
            $this->assign('data', $list);
        }
               
        
        
        return $this->fetch('chahuojingguo');
    }
    
    public function footer(){
       return $this->fetch('maker@common/footer');
    }
    
    /**告知笔录
     * @return mixed|string
     */
    public function gaozhibilu($index){
        $case = new TrafficCase($index);
        
        $this->assign([
            'zhidui'=>$case->getZhidui(),
            'dadui'=>$case->getDadui(),
            'code_1_content'=>$case->getCode1Content(), 
            'code_1_against'=>$case->getCode1Against(),
            'code_1_punish'=>$case->getCode1Punish(),
            'code_1_money'=>$case->getCode1Money(),
            'code_2_content'=>$case->getCode2Content(),
            'code_2_against'=>$case->getCode2Against(),
            'code_2_punish'=>$case->getCode2Punish(),
            'code_2_money'=>$case->getCode2Money(),
            'name'  => $case->getName(),
            'time' => $case->getTime(),
            'place'=>$case->getPlace(),
            'evidence'=>$case->getEvidence(),
            'car' =>$case->getCar(),
            'car_type' =>$case->getCarType(),
            
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
