<?php
namespace app\maker\model;

use think\Db;
use think\Model;

class Record extends Model
{
    
    public static function getDetail($id){
        return Db::table('record')->where('id='.$id)->field(['id','time','index','code_1','code_2','man','driver', 'car'])->find();
    }
    
    public static function add($dataArr, $owner)
    {
        $record = new Record;
        $record->index = empty($dataArr['index']) ? NULL : $dataArr['index'];
        $record->code_1 = empty($dataArr['code_1']) ? NULL : $dataArr['code_1'];
        $record->code_2 = empty($dataArr['code_2']) ? NULL : $dataArr['code_2'];
        $record->time = empty($dataArr['time']) ? NULL : $dataArr['time'];
        $record->judge_time = empty($dataArr['judge_time']) ? NULL : $dataArr['judge_time'];
        $record->place = empty($dataArr['place']) ? NULL : $dataArr['place'];
        $record->caughtTime= empty($dataArr['caughtTime']) ? NULL : $dataArr['caughtTime'];
        $record->zhidui= empty($dataArr['zhidui']) ? NULL : $dataArr['zhidui'];
        $record->dadui = empty($dataArr['dadui']) ? NULL : $dataArr['dadui'];
        $record->evidence = empty($dataArr['evidence']) ? NULL : $dataArr['evidence'];
        $record->doc_type = empty($dataArr['doc_type']) ? NULL : $dataArr['doc_type'];
        $record->doc_index = empty($dataArr['doc_index']) ? NULL : $dataArr['doc_index'];
        $record->police_1 = empty($dataArr['police_1']) ? NULL : $dataArr['police_1'];
        $record->police_2 = empty($dataArr['police_2']) ? NULL : $dataArr['police_2'];
        
        $man_id = Man::add($dataArr);
        $record->man = is_bool( $man_id) ? NULL : $man_id;
        
        $car_id = Car::add($dataArr);
        $record->car =  is_bool($car_id) ? NULL : $car_id;
        
        $driver_id = Driver::add($dataArr);
        $record->driver =  is_bool($driver_id) ? NULL : $driver_id;
        
        if ($record->save())
            return $record->id;
            
            return false;
    }
    
    public static function getById($id, $owner){
        
    }
    
    //必须保证传入的每个数据库键值都存在
    public static function refresh($id, $dataArr, $owner)
    {
        $record = Record::get($id);
        $record = $record->toArray();
        $record['index'] = empty($dataArr['index']) ? NULL : $dataArr['index'];
        $record['code_1'] = empty($dataArr['code_1']) ? NULL : $dataArr['code_1'];
        $record['code_2'] = empty($dataArr['code_2']) ? NULL : $dataArr['code_2'];
        $record['time'] = empty($dataArr['time']) ? NULL : $dataArr['time'];
        $record['judge_time']= empty($dataArr['judge_time']) ? NULL : $dataArr['judge_time'];
        $record['place'] = empty($dataArr['place']) ? NULL : $dataArr['place'];
        $record['caughtTime'] = empty($dataArr['caughtTime']) ? NULL : $dataArr['caughtTime'];
        $record['zhidui'] = empty($dataArr['zhidui']) ? NULL : $dataArr['zhidui'];
        $record['dadui'] = empty($dataArr['dadui']) ? NULL : $dataArr['dadui'];
        $record['evidence'] = empty($dataArr['evidence']) ? NULL : $dataArr['evidence'];
        $record['doc_type'] = empty($dataArr['doc_type']) ? NULL : $dataArr['doc_type'];
        $record['doc_index'] = empty($dataArr['doc_index']) ? NULL : $dataArr['doc_index'];
        $record['police_1'] = empty($dataArr['police_1']) ? NULL : $dataArr['police_1'];
        $record['police_2'] = empty($dataArr['police_2']) ? NULL : $dataArr['police_2'];
        
        $man_id  = Man::refresh($record['man'], $dataArr);
        $record['man'] = is_bool( $man_id) ? NULL : $man_id;
        
        $car_id = Car::refresh($record['car'], $dataArr);
        $record['car'] =  is_bool($car_id) ? NULL : $car_id;
        
        $driver_id = Driver::refresh($record['driver'], $dataArr);
        $record['driver'] =  is_bool($driver_id) ? NULL : $driver_id;
        
        //防止用NULL 覆盖了原值
        foreach ($record as $k => $v){
            if ($v == NULL) unset($record[$k]);
        }
        $effectRow = Db::name('record')->where('id', $id)->update($record);
        if ($effectRow)
            return $id;
            
            return false;
    }
    
    public static function remove($id, $owner)
    {
        $record = Record::get($id);
        if (!empty($record)){
            if(!empty($record->man))  Man::remove($record->man);
            if(!empty($record->driver))  Driver::remove($record->driver);
            if(!empty($record->car))  Car::remove($record->car);
            return $record->delete();
        }
            return false;
    }
    
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
        return $this->hasOne('Car','car_num','car_num');
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
    
    /**把几个违法行为区分开来，依次命名为1，2，3,
     * 防止不同违法行为的相同列名覆盖
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
    
    public function newRecord($case){
        
    }
}