<?php
namespace app\maker\model;

use think\Model;

class TempletMetaLabel extends Model implements iCURD
{
    public static function add($dataArr)
    {
        $model = new TempletMetaLabel();
        $model->templet_meta_catalog = empty($dataArr['templet_meta_catalog']) ? NULL : $dataArr['templet_meta_catalog'];
        $model->templet_meta_name = empty($dataArr['templet_meta_name']) ? NULL : $dataArr['templet_meta_name'];
        $model->templet_meta_owner = empty($dataArr['templet_meta_owner']) ? 0 : $dataArr['templet_meta_owner'];
        $model->templet_meta_remark = empty($dataArr['templet_meta_remark']) ? 0 : $dataArr['templet_meta_remark'];
        if ($model->save())
            return $model->id;
            
            return false;
    }

    public static function getById($id)
    {
        return db('templet_meta_label')->where('id', $id)->find();
    }

    public static function refresh($id, $dataArr)
    {
        $model = array();
        $model['templet_meta_catalog'] = empty($dataArr['templet_meta_catalog']) ? NULL : $dataArr['templet_meta_catalog'];
        $model['templet_meta_name'] = empty($dataArr['templet_meta_name']) ? NULL : $dataArr['templet_meta_name'];
        $model['templet_meta_owner'] = empty($dataArr['templet_meta_owner']) ? 0 : $dataArr['templet_meta_owner'];
        $model['templet_meta_remark'] = empty($dataArr['templet_meta_remark']) ? 0 : $dataArr['templet_meta_remark'];
    
        foreach ($model as $k => $v){
            if ($v == NULL) unset($model[$k]);
        }
        
        $effectRowId = db('templet_meta_label')->where('id', $id)->update($model);
        if ($effectRowId)
            return $id;
            
            return false;
    }

    public static function remove($id)
    {
        $model = TempletMetaLabel::get($id);
        if (!empty($model))
            return $model->delete();
            return false;
    }
    
    public static function getMetaArr($ownerId = ''){
        if (!empty($ownerId))
            return db('templet_meta_label')->where('templet_meta_owner',$ownerId)->select();
        
            else 
                return db('templet_meta_label')->select();
    }


}