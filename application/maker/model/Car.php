<?php
namespace app\maker\model;

use think\Model;

class Car extends Model
{
    public static function add($dataArr = Array(), $field = NULL){
        $car = new Car;
        $car->car_num = empty($dataArr['car_num']) ? NULL : $dataArr['car_num'];
        $car->car_type = empty($dataArr['car_type']) ? NULL : $dataArr['car_type'];
        $car->car_owner = empty($dataArr['car_owner']) ? NULL : $dataArr['car_owner'];
        $car->car_expire = empty($dataArr['car_expire']) ? NULL : $dataArr['car_expire'];
        if ($car->save()) 
            return $car->id;
       
            return false;
    }
    
    public static function remove(){
        
    }
    
    public static function refresh($id, $dataArr){
        $car = Car::get($id);
        $car->car_num = empty($dataArr['car_num']) ? NULL : $dataArr['car_num'];
        $car->car_type = empty($dataArr['car_type']) ? NULL : $dataArr['car_type'];
        $car->car_owner = empty($dataArr['car_owner']) ? NULL : $dataArr['car_owner'];
        $car->car_expire = empty($dataArr['car_expire']) ? NULL : $dataArr['car_expire'];
        if ($car->save())
            return $car->id;
            
            return false;
    }
    
}