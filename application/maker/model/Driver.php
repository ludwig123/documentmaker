<?php
namespace app\maker\model;

use think\Model;

class Driver extends Model
{
    public function add($dataArr)
    {
        $driver = new Driver;
        $driver->identity = empty($dataArr['identity']) ? NULL : $dataArr['identity'];
        $driver->file_num = empty($dataArr['file_num']) ? NULL : $dataArr['file_num'];
        $driver->issuer = empty($dataArr['issuer']) ? NULL : $dataArr['issuer'];
        $driver->driver_type = empty($dataArr['driver_type']) ? NULL : $dataArr['driver_type'];
        if ($driver->save())
            return $driver->id;
            
            return false;
    }
    
    
    public function refresh($id, $dataArr)
    {
        $driver = Driver::get($id);
        $driver->car_num = empty($dataArr['car_num']) ? NULL : $dataArr['car_num'];
        $driver->car_type = empty($dataArr['car_type']) ? NULL : $dataArr['car_type'];
        $driver->car_owner = empty($dataArr['car_owner']) ? NULL : $dataArr['car_owner'];
        $driver->car_expire = empty($dataArr['car_expire']) ? NULL : $dataArr['car_expire'];
        if ($driver->save())
            return $driver->id;
            
            return false;
    }
    
    public function remove($id)
    {
        $driver = Driver::get($id);
        if (!empty($driver))
            return $driver->delete();
            return false;
    }
}