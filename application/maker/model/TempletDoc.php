<?php
namespace app\maker\model;

use think\Db;
use think\Model;

class TempletDoc extends Model
{

    public static function getById($id){
        return db('templet')->where('id', $id)->find();
    }
    
    public static function getByIdLogin($templetId,$ownerId = '' ){
        if (empty($ownerId))
            return db('templet')->where('id ='.$templetId)->find();
        
            else return db('templet')->where('id ='.$templetId)
                                     ->where('templet_owner ='.$ownerId)->find();
    }
    
    public static function getByOwner($ownerId){
        return db('templet')->where('templet_owner ='.$ownerId)->select();
    }
    
    
    /**添加一个新车辆
     * @param array $dataArr
     * @return integer|boolean 成功返回id,失败返回false
     */
    public static function add($dataArr){
        $templet = new TempletDoc;
        $templet->templet_catalog = empty($dataArr['templet_catalog']) ? NULL : $dataArr['templet_catalog'];
        $templet->templet_name = empty($dataArr['templet_name']) ? NULL : $dataArr['templet_name'];
        $templet->templet_content = empty($dataArr['templet_content']) ? NULL : $dataArr['templet_content'];
        $templet->templet_owner = empty($dataArr['templet_owner']) ? 0 : $dataArr['templet_owner'];
        if ($templet->save())
            return $templet->id;
            
            return false;
    }
    
    public static function remove($id){
        $obj = TempletDoc::get($id);
        if (!empty($obj))
            return $obj->delete();
            return false;
    }
    
    public static function refresh($id = '', $dataArr){
        $templet = array();
        $templet['templet_catalog'] = empty($dataArr['templet_catalog']) ? NULL : $dataArr['templet_catalog'];
        $templet['templet_name'] = empty($dataArr['templet_name']) ? NULL : $dataArr['templet_name'];
        $templet['templet_content'] = empty($dataArr['templet_content']) ? NULL : $dataArr['templet_content'];
        $templet['templet_owner'] = empty($dataArr['templet_owner']) ? NULL : $dataArr['templet_owner'];
        
        foreach ($templet as $k => $v){
            if ($v == NULL) unset($templet[$k]);
        }
        $effectRow = Db::name('templet')->where('id', $id)->update($templet);
        if ($effectRow)
            return $id;
            
            return false;
    }
    
}