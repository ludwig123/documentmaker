<?php
namespace app\maker\controller;

use think\Controller;
use app\maker\model\Code;
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
        //在页面注入案件的ID
        $this->assign([
            'id'  => $id
        ]);
        return $this->fetch("form");
    }
    
    public function shenpibiao($id){
        $list = TrafficCase::findById($id);
        if (!empty($list)){
            $this->assign('data', $list);
        }
        return $this->fetch("shenpibiao");
    }
    
    /**查获经过
     * @return mixed|string
     */
    public function chahuojingguo($id){
        $list = TrafficCase::findById($id);
        if (!empty($list)){
            $this->assign('data', $list);
        }
               
        return $this->fetch('chahuojingguo');
    }
    
    public function footer(){
       return $this->fetch('maker@common/footer');
    }

    /**
     * 告知笔录
     *
     * @return mixed|string
     */
    public function gaozhibilu($id)
    {
        $list = TrafficCase::findById($id);
        
        $code_1 = $code_2 = array();
        if (! empty($list['code_1'])) {
            $code = Code::where('违法代码', $list['code_1'])->find();
            if (! empty($code)) {
                $code = $code->toArray();
                foreach ($code as $k => $v) {
                    $code_1[$k . '_1'] = $v;
                }
            }
        }
        if (! empty($list['code_2'])){
            $code = Code::where('违法代码', $list['code_2'])->find();
            $code = $code->toArray();
            foreach ($code as $k =>$v){
                $code_2[$k.'_2'] = $v;
            }
        }
        
        $list = array_merge($list, $code_1, $code_2);
        
        if (!empty($list)){
            $this->assign('data', $list);
        }
        return $this->fetch('gaozhibilu');
    }
    
    public function juedingshu($id){
        $list = TrafficCase::findById($id);
        
        $code_1 = $code_2 = array();
        if (! empty($list['code_1'])) {
            $code = Code::where('违法代码', $list['code_1'])->find();
            if (! empty($code)) {
                $code = $code->toArray();
                foreach ($code as $k => $v) {
                    $code_1[$k . '_1'] = $v;
                }
            }
        }
        if (! empty($list['code_2'])){
            $code = Code::where('违法代码', $list['code_2'])->find();
            $code = $code->toArray();
            foreach ($code as $k =>$v){
                $code_2[$k.'_2'] = $v;
            }
        }
        
        $list = array_merge($list, $code_1, $code_2);
        
        if (!empty($list)){
            $this->assign('data', $list);
        }
        
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
    
    
    private function addPage(){
        
    }
    
}
