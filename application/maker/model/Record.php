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
            $v = $this->separateCode($v);
            $lists[]= $this->flatArray($v);
    }
    return $lists;
    }
    
    /**通过案卷编号来查找案卷，暂不支持模糊查询
     * @param string $index
     * @return NULL|NULL|array
     */
    public function getRecordByIndex($index){
        $reocrd = Record::where('index',$index)->with([
            'man',
            'driver',
            'car',
            'code_1',
            'code_2'
        ])->select();
            $record = $reocrd->toArray();
            if (empty($record)){
                return NULL;
            }
            $record = $record[0];
            $record = $this->separateCode($record);
            $lists = $this->flatArray($record);
            
            return $lists;
            
    }
    
    /**通过Id号来查找案卷，暂不支持模糊查询
     * @param string $index
     * @return NULL|NULL|array
     */
    public function getRecordById($id){
        $reocrd = Record::where('Id',$id)->with([
            'man',
            'driver',
            'car',
            'code_1',
            'code_2'
        ])->select();
        $record = $reocrd->toArray();
        if (empty($record)){
            return NULL;
        }
        $record = $record[0];
        $record = $this->separateCode($record);
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
    
    /**把几个违法行为区分开来，依次命名为1，2，3
     * 
     */
    public function separateCode($record){
        $code_1 = $record['code_1'];
        $code_2 = $record['code_2'];
        
        foreach ($code_1 as $k => $v){
            unset($code_1[$k]);
            $code_1[$k.'1'] = $v; 
        }
        
        if (!empty($code_2)){
        foreach ($code_2 as $k => $v){
            unset($code_2[$k]);
            $code_2[$k.'2'] = $v;
        }
        }
        
         $record['code_1'] = $code_1;
         $record['code_2'] = $code_2;
         
         return $record;
        
    }
    
    public function addRecord(){
        
    }
}