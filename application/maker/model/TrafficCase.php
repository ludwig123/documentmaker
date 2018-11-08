<?php
namespace app\maker\model;

use think\Db;


/**
 * 单个案件的抽象接口，通过其访问模型
 *
 * @author ludwig
 *        
 */
class TrafficCase
{
    
    public function all(){
        $records = Record::field(['identity'],true)->select();
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
            
            
            $codeContentArr = self::getCodeContentArr($record);
        
            $case = array_merge($recordArr,$manArr, $carArr, $codeContentArr);
            
            
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
      $man = Man::where('id', $record->man)->field(['id'],true)->find();
      if(!empty($man)){
          $manArr = $man->toArray();
      }
      $car = Car::where('id', $record->car)->field(['id'],true)->find();
      if (!empty($car)){
          $carArr = $car->toArray();
      }
      
      $driver = Driver::where('id', $record->driver)->field(['id'],true)->find();
      if (!empty($driver)){
          $driverArr = $driver->toArray();
      }

      $codeContentArr = self::getCodeContentArr($record);
      
      $case = array_merge($recordArr,$manArr, $carArr,$driverArr, $codeContentArr);
        
        return $case;
    }
    
    
    public function add($data){
        return Record::add($data);
    }
    
    public function refresh($id, $dataArr){
        return Record::refresh($id, $dataArr);
    }
    
    public function remove($id){
       return Record::remove($id);
    }
    

    public static function getCodeContent($code){
        return Db::table('code')->where("违法代码=".$code)->field('违法内容')->find();
    }
    
    private static function getCodeContentArr($record){
        $code_1 = $code_2 = array();
        $code = self::getCodeContent($record['code_1']);
        if (!empty($code)){
            foreach ($code as $k =>$v){
                $code_1[$k.'_1'] = $v;
            }
        }
        
        if (!empty($record->code_2)){
            $code = self::getCodeContent($record['code_2']);
            if (!empty($code)){
                foreach ($code as $k =>$v){
                    $code_2[$k.'_2'] = $v;
                }
            }
        }
        
        return array_merge($code_1, $code_2);
    }
       
        
}