<?php
namespace app\maker\model;

use think\Db;
use think\Model;

class Templet extends Model
{
    public static function getDetail($id){
        
    }
    
    /**添加一个新车辆
     * @param array $dataArr
     * @return integer|boolean 成功返回id,失败返回false
     */
    public static function add($dataArr){
        $car = new Templet;
        $car->car_num = empty($dataArr['car_num']) ? NULL : $dataArr['car_num'];
        $car->car_type = empty($dataArr['car_type']) ? NULL : $dataArr['car_type'];
        $car->car_owner = empty($dataArr['car_owner']) ? NULL : $dataArr['car_owner'];
        $car->car_expire = empty($dataArr['car_expire']) ? NULL : $dataArr['car_expire'];
        if ($car->save())
            return $car->id;
            
            return false;
    }
    
    public static function remove($id){
        $car = Templet::get($id);
        if (!empty($car))
            return $car->delete();
            return false;
    }
    
    public static function refresh($id, $dataArr){
        $car = array();
        $car['car_num'] = empty($dataArr['car_num']) ? NULL : $dataArr['car_num'];
        $car['car_type'] = empty($dataArr['car_type']) ? NULL : $dataArr['car_type'];
        $car['car_owner'] = empty($dataArr['car_owner']) ? NULL : $dataArr['car_owner'];
        $car['car_expire'] = empty($dataArr['car_expire']) ? NULL : $dataArr['car_expire'];
        
        foreach ($car as $k => $v){
            if ($v == NULL) unset($car[$k]);
        }
        $effectRow = Db::name('car')->where('id', $id)->update($car);
        if ($effectRow)
            return $id;
            
            return false;
    }
    
}