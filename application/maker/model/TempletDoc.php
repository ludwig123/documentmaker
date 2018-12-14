<?php
namespace app\maker\model;

use think\Db;
use think\Model;

class TempletDoc extends Model
{

    public static function getById($id){
        return db('templet_doc')->where('id', $id)->find();
    }
    
    public static function getByIdLogin($templetId,$ownerId = '' ){
        if (empty($ownerId))
            return db('templet_doc')->where('id ='.$templetId)->find();
        
            else return db('templet_doc')->where('id ='.$templetId)
                                     ->where('templet_owner ='.$ownerId)->find();
    }
    
    public static function getByOwner($ownerId){
        return db('templet_doc')->where('templet_owner ='.$ownerId)->select();
    }
    
    public static function getByGroupId($groupId){
        return db('templet_doc')->where('templet_group_id ='.$groupId)->select();
    }
    
    public static function getCatalogArr(){
        return db('templet_doc')->distinct(true)->field('templet_catalog')->select();
    }
    
    
    /**添加一个新车辆
     * @param array $dataArr
     * @return integer|boolean 成功返回id,失败返回false
     */
    public static function add($dataArr){
        $templet = new TempletDoc;
        $templet->templet_group_id = empty($dataArr['templet_group_id']) ? 0 : $dataArr['templet_group_id'];
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
    
    public static function removeByGroupId($id){
        return db('templet_doc')->where('templet_group_id', $id)->delete();
    }
    
    public static function refresh($id = '', $dataArr){
        $templet = array();
        $templet['templet_group_id'] = empty($dataArr['templet_group_id']) ? NULL : $dataArr['templet_group_id'];
        $templet['templet_catalog'] = empty($dataArr['templet_catalog']) ? NULL : $dataArr['templet_catalog'];
        $templet['templet_name'] = empty($dataArr['templet_name']) ? NULL : $dataArr['templet_name'];
        $templet['templet_content'] = empty($dataArr['templet_content']) ? NULL : $dataArr['templet_content'];
        $templet['templet_owner'] = empty($dataArr['templet_owner']) ? NULL : $dataArr['templet_owner'];
        
        foreach ($templet as $k => $v){
            if ($v == NULL) unset($templet[$k]);
        }
        $effectRowId = Db::name('templet_doc')->where('id', $id)->update($templet);
        if ($effectRowId)
            return $id;
            
            return false;
    }
    
}