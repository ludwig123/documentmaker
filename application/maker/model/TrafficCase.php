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
            if (!empty($record)){
                $recordArr = $record->toArray();
            }
            
            $man = Man::where('id', $record->man)->field(['name'])->find();
            if(!empty($man)){
                $manArr = $man->toArray();
            }
            $car = Car::where('id', $record->car)->field(['car_num', 'car_type'])->find();
            if (!empty($car)){
                $carArr = $car->toArray();
            }
            $code_1 = $code_2 = array();
            $code = Code::where('违法代码', $record->code_1)->field( '违法内容')->find();
            if (!empty($code)){
            $code = $code->toArray();
            foreach ($code as $k =>$v){
                $code_1[$k.'_1'] = $v;
            }
            }
            
            if (!empty($record->code_2)){
                $code = Code::where('违法代码', $record->code_2)->field( '违法内容')->find();
                $code = $code->toArray();
                foreach ($code as $k =>$v){
                    $code_2[$k.'_2'] = $v;
                }
            }
            
            $case = array_merge($recordArr,$manArr, $carArr, $code_1, $code_2);
            
            
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
      
      $recordArr = $record->toArray();
      
      $carArr = $manArr = $driverArr = array();
      $man = Man::where('id', $record->man)->find();
      if(!empty($man)){
          $manArr = $man->toArray();
      }
      $car = Car::where('id', $record->car)->find();
      if (!empty($car)){
          $carArr = $car->toArray();
      }
      
      $driver = Driver::where('id', $record->car)->find();
      if (!empty($driver)){
          $driverArr = $driver->toArray();
      }
      $code_1 = $code_2 = array();
      $code = Code::where('违法代码', $record->code_1)->field( '违法内容')->find();
      if (!empty($code)){
          $code = $code->toArray();
          foreach ($code as $k =>$v){
              $code_1[$k.'_1'] = $v;
          }
      }
      
      if (!empty($record->code_2)){
          $code = Code::where('违法代码', $record->code_2)->field( '违法内容')->find();
          $code = $code->toArray();
          foreach ($code as $k =>$v){
              $code_2[$k.'_2'] = $v;
          }
      }
      
      $case = array_merge($recordArr,$manArr, $carArr,$driverArr, $code_1, $code_2);
        
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
    

   
        
}