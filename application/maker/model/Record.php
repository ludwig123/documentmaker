<?php
namespace app\maker\model;

use think\Model;

class Record extends Model
{
    //以下是关联模型的定义
    /**关联个人信息，含身份证
     * @return \think\model\relation\HasOne
     */
    public function man(){
        return $this->hasOne('Man','identity','identity');
    }
    
    /**关联车辆证信息
     * @return \think\model\relation\HasOne
     */
    public function car(){
        return $this->hasOne('Car','car','car');
    }
    
    /**关联驾驶证信息
     * @return \think\model\relation\HasOne
     */
    public function driver(){
        return $this->hasOne('Driver','identity','identity');
    }
    
    /**关联主要违法代码
     * @return \think\model\relation\HasOne
     */
    public function code_1(){
        return $this->hasOne('Code','违法代码','code_1');
    }
    
    /**关联第二个违法代码
     * @return \think\model\relation\HasOne
     */
    public function code_2(){
        return $this->hasOne('Code','违法代码','code_2');
    }
    //结束：关联模型的定义
    
    
    /**获取所有的列表详情
     * @return array[]
     */
    public function records(){
        $records = $this::with([
            'man',
            'driver',
            'car',
            'code_1',
            'code_2'
        ])->select();
        $data = $records->toArray();
        $lists = array();
        foreach ($data as $v) {
            $car = $v['car'];
            unset($v['car']);
            
            $driver = $v['driver'];
            unset($v['driver']);
            
            $man = $v['man'];
            unset($v['man']);
            
            $code_1 = $v['code_1'];
            unset($v['code_1']);
            
            //防止$code_2不存在造成的错误
            $code_2 = array();
            if (!empty($v['code_2'])){
                $code_2 = $v['code_2'];
                unset($v['code_2']);
            }
            
            $lists[]= array_merge($v, $car, $man, $driver,$code_1,$code_2);
    }
    return $lists;
    }
    
    public function getRecordByIndex($index){
        $reocrd = Record::where('index',$index)->with([
            'man',
            'driver',
            'car',
            'code_1',
            'code_2'
        ])->select();
            $record = $reocrd->toArray();
            $record = $record[0];
            
            $lists = $this->flatArray($record);
            
            return $lists;
            
    }
    
    /**将value中包含的数组，放入该数组中
     * @param array $src
     * @return NULL|array
     */
    public function flatArray($src){
        if (empty($src)){
            return NULL;
        }
        $des = array();
        foreach ($src as $k => $v){
            if (is_array($v)){
                $des =  array_merge($des, $this->flatArray($v));
            }
            else $des[$k] = $v;
        }
        
        return $des;
    }
    
    public function addRecord(){
        
    }
}