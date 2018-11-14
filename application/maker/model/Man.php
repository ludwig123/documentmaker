<?php
namespace app\maker\model;

use think\Db;
use think\Model;

class Man extends Model
{
    public static function find(){
        
    }
    
    public static function add($dataArr)
    {
        $man = array();
        $man['identity'] = empty($dataArr['identity']) ? NULL : $dataArr['identity'];
        $man['name'] = empty($dataArr['name']) ? NULL : $dataArr['name'];
        $man['sex']  = empty($dataArr['sex']) ? NULL : $dataArr['sex'];
        $man['phone'] = empty($dataArr['phone']) ? NULL : $dataArr['phone'];
        $man['address'] = empty($dataArr['address']) ? NULL : $dataArr['address'];
        $man['education'] = empty($dataArr['education']) ? NULL : $dataArr['education'];
        $man['political'] = empty($dataArr['political']) ? NULL : $dataArr['political'];
        $man['company'] = empty($dataArr['company']) ? NULL : $dataArr['company'];
        $man['nation'] = empty($dataArr['nation']) ? NULL : $dataArr['nation'];
        $man['birth_place'] = empty($dataArr['birth_place']) ? NULL : $dataArr['birth_place'];
        $id = Db::name('man')->insertGetId($man);
        if ($id)
            return $id;
            
            return false;
    }
    
    
    public static function refresh($id, $dataArr)
    {
        $man = array();
        $man['identity'] = empty($dataArr['identity']) ? NULL : $dataArr['identity'];
        $man['name'] = empty($dataArr['name']) ? NULL : $dataArr['name'];
        $man['sex']  = empty($dataArr['sex']) ? NULL : $dataArr['sex'];
        $man['phone'] = empty($dataArr['phone']) ? NULL : $dataArr['phone'];
        $man['address'] = empty($dataArr['address']) ? NULL : $dataArr['address'];
        $man['education'] = empty($dataArr['education']) ? NULL : $dataArr['education'];
        $man['political'] = empty($dataArr['political']) ? NULL : $dataArr['political'];
        $man['company'] = empty($dataArr['company']) ? NULL : $dataArr['company'];
        $man['nation'] = empty($dataArr['nation']) ? NULL : $dataArr['nation'];
        $man['birth_place'] = empty($dataArr['birth_place']) ? NULL : $dataArr['birth_place'];
        foreach ($man as $k => $v){
            if ($v == NULL) unset($man[$k]);
        }
        $effectRow = Db::name('man')->where('id', $id)->update($man);
        if ($effectRow)
            return $id;
            
            return false;
        
    }
    
    public static function remove($id)
    {
        $man = Man::get($id);
        if (!empty($man))
            return $man->delete();
            return false;
    }
}