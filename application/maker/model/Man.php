<?php
namespace app\maker\model;

use think\Model;

class Man extends Model
{
    public function add($dataArr)
    {
        $man = new Man;
        $man->identity = empty($dataArr['caridentity']) ? NULL : $dataArr['identity'];
        $man->name = empty($dataArr['name']) ? NULL : $dataArr['name'];
        $man->sex = empty($dataArr['sex']) ? NULL : $dataArr['sex'];
        $man->phone = empty($dataArr['phone']) ? NULL : $dataArr['phone'];
        $man->address = empty($dataArr['address']) ? NULL : $dataArr['address'];
        $man->education= empty($dataArr['education']) ? NULL : $dataArr['education'];
        $man->political= empty($dataArr['political']) ? NULL : $dataArr['political'];
        $man->company = empty($dataArr['company']) ? NULL : $dataArr['company'];
        $man->nation = empty($dataArr['nation']) ? NULL : $dataArr['nation'];
        $man->birth_place = empty($dataArr['birth_place']) ? NULL : $dataArr['birth_place'];
        if ($man->save())
            return $man->id;
            
            return false;
    }
    
    
    public function refresh($id, $dataArr)
    {
        $man = Man::get($id);
        $man->identity = empty($dataArr['caridentity']) ? NULL : $dataArr['identity'];
        $man->name = empty($dataArr['name']) ? NULL : $dataArr['name'];
        $man->sex = empty($dataArr['sex']) ? NULL : $dataArr['sex'];
        $man->phone = empty($dataArr['phone']) ? NULL : $dataArr['phone'];
        $man->address = empty($dataArr['address']) ? NULL : $dataArr['address'];
        $man->education= empty($dataArr['education']) ? NULL : $dataArr['education'];
        $man->political= empty($dataArr['political']) ? NULL : $dataArr['political'];
        $man->company = empty($dataArr['company']) ? NULL : $dataArr['company'];
        $man->nation = empty($dataArr['nation']) ? NULL : $dataArr['nation'];
        $man->birth_place = empty($dataArr['birth_place']) ? NULL : $dataArr['birth_place'];
        if ($man->save())
            return $man->id;
            
            return false;
        
    }
    
    public function remove($id)
    {
        $car = Car::get($id);
        if (!empty($car))
            return $car->delete();
            return false;
    }
}