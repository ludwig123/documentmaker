<?php
namespace app\maker\model;


/**
 * 单个案件的抽象接口，通过其访问模型
 *
 * @author ludwig
 *        
 */
class TrafficCase
{

    public $case;


    /**新建一个案件或者通过关键词查询一个案件
     * @param string $val  查询案件的关键词
     * @param string $type 关键词的种类
     */
    function __construct($val = '', $type = '')
    {
    }
    
    /**更新Id指明的数据
     * @param string $data
     */
    public function update($data){
        $record = Record::get($data['id']);
        if (empty($record)){
            return NUll;
        }
        $car = new Car;
        $man = new Man;
        $driver = new Driver;
        
        $car->save($data);
        $man->save($data);
        $driver->save($data);
        

    }
    
    public function all(){
        $records = Record::field(['identity','car_num','car_type'],true)->select();
        if (empty($records)){
            return NULL;
        }
        $cases = array();
        foreach ($records as  $index =>$record){
            
            $record = Record::where('id', $record->id)->field(['id','time','index','code_1','code_2','man','driver', 'car'])->find();
            if (empty($record)){
                return NULL;
            }
            
            $man = Man::where('id', $record->man)->field(['name'])->find();
            $car = Car::where('id', $record->car)->field(['car_num', 'car_type'])->find();
            
            $code_1 = $code_2 = array();
            $code = Code::where('违法代码', $record->code_1)->field( '违法内容')->find();
            $code = $code->toArray();
            foreach ($code as $k =>$v){
                $code_1[$k.'_1'] = $v;
            }
            
            if (!empty($record->code_2)){
                $code = Code::where('违法代码', $record->code_2)->field( '违法内容')->find();
                $code = $code->toArray();
                foreach ($code as $k =>$v){
                    $code_2[$k.'_2'] = $v;
                }
            }
            
            $case = array_merge($record->toArray(),$man->toArray(), $car->toArray(), $code_1, $code_2);
            
            
            $cases[] = $case;
        }
        
        return $cases;
    }
    
    //这里不应该把违法的详细内容提供出去，应该等需要的时候再查询
    public  static function findById($id){
        $record = Record::where('id', $id)->field(['identity','car_num','car_type'],true)->find();
      if (empty($record)){
          return NULL;
      }
      
      $man = Man::where('id', $record->man)->field(['id'],true)->find();
      $driver = Driver::where('id', $record->driver)->field(['id'],true)->find();
      $car = Car::where('id', $record->car)->field(['id'],true)->find();
      
      $code_1 = $code_2 = array();
      $code = Code::where('违法代码', $record->code_1)->field( '违法代码,违法内容')->find();
      $code = $code->toArray();
      foreach ($code as $k =>$v){
          $code_1[$k.'_1'] = $v;
      }
      
      if (!empty($record->code_2)){
          $code = Code::where('违法代码', $record->code_2)->field( '违法代码,违法内容')->find();
          $code = $code->toArray();
          foreach ($code as $k =>$v){
              $code_2[$k.'_2'] = $v;
          }
      }
      $case = array_merge($record->toArray(),$man->toArray(), $driver->toArray(), $car->toArray(), $code_1, $code_2);
        
        return $case;
    }
    
    
    public function add($data){
      $car_id = Car::add($data);  
      $man_id = Man::add($data);
    }
    
    public function refresh($id, $data){
        
    }
    
    public function delete($id){
        
    }
    
    

    private function init($val){
        $this->setIndex($val['index']);
        $this->setTime($val['time']);
        $this->setPlace($val['place']);
        $this->setDocType($val['doc_type']);
    }
    /**
     * 决定书编号
     */
    public function getIndex()
    {
        return $this->case['index'];
    }

    public function getTime()
    {
        return $this->case['time'];
    }

    public function getPlace()
    {
        return $this->case['place'];
    }

    /**
     * 当事人名字
     */
    public function getName()
    {
        return $this->case['name'];
    }

    /**
     * 身份证号码
     */
    public function getIdentity()
    {
        return $this->case['identity'];
    }

    public function getZhidui()
    {
        return $this->case['zhidui'];
    }

    public function getDadui()
    {
        return $this->case['dadui'];
    }

    public function getEvidence()
    {
        return $this->case['evidence'];
    }

    public function getDocType()
    {
        return $this->case['doc_type'];
    }

    public function getPolice1()
    {
        return $this->case['police_1'];
    }

    public function getPolice2()
    {
        return $this->case['police_2'];
    }

    public function getSex()
    {
        return $this->case['sex'];
    }

    /**
     * 车牌号
     */
    public function getCar()
    {
        return $this->case['car'];
    }

    /**
     * 车辆类型
     */
    public function getCarType()
    {
        return $this->case['car_type'];
    }

    public function getPhone()
    {
        return $this->case['phone'];
    }

    public function getAddress()
    {
        return $this->case['address'];
    }

    public function getEducation()
    {
        return $this->case['education'];
    }

    /**
     * 工作单位
     */
    public function getCompany()
    {
        return $this->case['company'];
    }

    /**
     * 政治面貌
     */
    public function getPolitical()
    {
        return $this->case['political'];
    }

    /**
     * 档案编号
     */
    public function getFileNum()
    {
        return $this->case['file_num'];
    }

    /**
     * 发证机关
     */
    public function getIssuer()
    {
        return $this->case['issuer'];
    }

    /**
     * 准驾车型
     */
    public function getDriverType()
    {
        return $this->case['type'];
    }

    public function getCode1()
    {
        return $this->case['违法代码1'];
    }

    public function getCode1Content()
    {
        return $this->case['违法内容1'];
    }

    public function getCode1Against()
    {
        return $this->case['违法条款1'];
    }

    public function getCode1Punish()
    {
        return $this->case['处罚依据1'];
    }

    public function getCode1Money()
    {
        return $this->case['罚款金额1'];
    }

    public function getCode2()
    {
        return array_key_exists('code_2', $this->case) ? NULL : $this->case['违法代码2'];
    }

    public function getCode2Content()
    {
        return array_key_exists('code_2', $this->case) ? NULL : $this->case['违法内容2'];
    }

    public function getCode2Against()
    {
        return array_key_exists('code_2', $this->case) ? NULL : $this->case['违法条款2'];
    }

    public function getCode2Punish()
    {
        return array_key_exists('code_2', $this->case) ? NULL : $this->case['处罚依据2'];
    }

    public function getCode2Money()
    {
        return array_key_exists('code_2', $this->case) ? NULL : $this->case['罚款金额2'];
    }

    // set方法
    /**
     * 决定书编号
     */
    public function setIndex($val)
    {
        return $this->case['index'] = $val;
    }

    public function setTime($val)
    {
        return $this->case['time'] = $val;
    }

    public function setPlace($val)
    {
        return $this->case['place'] = $val;
    }

    /**
     * 当事人名字
     */
    public function setName($val)
    {
        return $this->case['name'] = $val;
    }

    /**
     * 身份证号码
     */
    public function setIdentity($val)
    {
        return $this->case['identity'] = $val;
    }

    public function setZhidui($val)
    {
        return $this->case['zhidui'] = $val;
    }

    public function setDadui($val)
    {
        return $this->case['dadui'] = $val;
    }

    public function setEvidence($val)
    {
        return $this->case['evidence'] = $val;
    }

    public function setDocType($val)
    {
        return $this->case['doc_type'] = $val;
    }

    public function setPolice1($val)
    {
        return $this->case['police_1'] = $val;
    }

    public function setPolice2($val)
    {
        return $this->case['police_2'] = $val;
    }

    public function setSex($val)
    {
        return $this->case['sex'] = $val;
    }

    /**
     * 车牌号
     */
    public function setCar($val)
    {
        return $this->case['car'] = $val;
    }

    /**
     * 车辆类型
     */
    public function setCarType($val)
    {
        return $this->case['car_type'] = $val;
    }

    public function setPhone($val)
    {
        return $this->case['phone'] = $val;
    }

    public function setAddress($val)
    {
        return $this->case['address'] = $val;
    }

    public function setEducation($val)
    {
        return $this->case['education'] = $val;
    }

    /**
     * 工作单位
     */
    public function setCompany($val)
    {
        return $this->case['company'] = $val;
    }

    /**
     * 政治面貌
     */
    public function setPolitical($val)
    {
        return $this->case['political'] = $val;
    }

    /**
     * 档案编号
     */
    public function setFileNum($val)
    {
        return $this->case['file_num'] = $val;
    }

    /**
     * 发证机关
     */
    public function setIssuer($val)
    {
        return $this->case['issuer'] = $val;
    }

    /**
     * 准驾车型
     */
    public function setDriverType($val)
    {
        return $this->case['type'] = $val;
    }

    public function setCode1($val)
    {
        return $this->case['违法代码1'] = $val;
    }

    public function setCode1Content($val)
    {
        return $this->case['违法内容1'] = $val;
    }

    public function setCode1Against($val)
    {
        return $this->case['违法条款1'] = $val;
    }

    public function setCode1Punish($val)
    {
        return $this->case['处罚依据1'] = $val;
    }

    public function setCode1Money($val)
    {
        return $this->case['罚款金额1'] = $val;
    }
    
    public function setCode2($val){
        return $this->case['违法代码2'] = $val;
    }
    
    public function setCode2Content($val){
        return $this->case['违法内容2'] = $val;
    }
    
    public function setCode2Against($val){
        return  $this->case['违法条款2'] = $val;
    }
    
    public function setCode2Punish($val){
        return $this->case['处罚依据2'] = $val;
    }
    
    public function setCode2Money($val){
        return $this->case['罚款金额2'] = $val;
    }
        
}