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
        $data = TrafficCase::findById($id);
        
        $code_1 = $code_2 = array();
        if (! empty($data['code_1'])) {
            //$code = Code::where('违法代码', $list['code_1'])->find();
            $code =  Db::table('code')->where("违法代码=".$data['code_1'])->find();
            if (! empty($code)) {
               
                foreach ($code as $k => $v) {
                    $code_1[$k . '_1'] = $v;
                }
            }
        }
        if (! empty($data['code_2'])){
            $code =  Db::table('code')->where("违法代码=".$data['code_2'])->find();
            foreach ($code as $k =>$v){
                $code_2[$k.'_2'] = $v;
            }
        }
        
        $data = array_merge($data, $code_1, $code_2);
        
        if (!empty($data)){
            $this->assign('data', $data);
        }
        
        $content = $punish = '';
        
        $content = '<p class="police-section">
						现查明你于<u>'.$data['time'].'，驾驶牌号为'.$data['car_num'].'的'.$data['car_num'].'行驶至'.$data['car_num'].'，实施'.$data['car_num'].'，被民警当场查获。</u>
					</p>
					<p class="police-section">
						以上事实有<u>交通违法嫌疑人'.$data['car_num'].'的'.$data['car_num'].'</u>予以证实。
					</p>';
        $activity = '，'.$data['违法内容_2'];
        if (!empty($data['违法内容_2'])){
            $punish = '';
            
        }
        ;
        
        $this->assign('content', $content);
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
    
   
    
}
