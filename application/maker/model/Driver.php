<?php
namespace app\maker\model;

use think\Model;

class Driver extends Model
{
    public static function add($dataArr)
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
    
    
    public static function refresh($id, $dataArr)
    {
        $driver = Driver::get($id);
        $driver->identity = empty($dataArr['identity']) ? NULL : $dataArr['identity'];
        $driver->file_num = empty($dataArr['file_num']) ? NULL : $dataArr['file_num'];
        $driver->issuer = empty($dataArr['issuer']) ? NULL : $dataArr['issuer'];
        $driver->driver_type = empty($dataArr['driver_type']) ? NULL : $dataArr['driver_type'];
        if ($driver->save())
            return $driver->id;
            
            return false;
    }
    
    public static function remove($id)
    {
        $driver = Driver::get($id);
        if (!empty($driver))
            return $driver->delete();
            return false;
    }
}