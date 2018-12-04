<?php
namespace app\maker\model;

use think\Model;

class Archive extends Model implements iCURD
{
    public static function add($dataArr)
    {
        $model = new Archive();
        $model->archive_group_id = empty($dataArr['archive_group_id']) ? NULL : $dataArr['archive_group_id'];
        $model->archive_catalog = empty($dataArr['archive_catalog']) ? NULL : $dataArr['archive_catalog'];
        $model->archive_content = empty($dataArr['archive_content']) ? NULL : $dataArr['archive_content'];
        $model->archive_name = empty($dataArr['archive_name']) ? NULL : $dataArr['archive_name'];
        $model->archive_owner = empty($dataArr['archive_owner']) ? 0 : $dataArr['archive_owner'];
        $model->archive_remark = empty($dataArr['archive_remark']) ? NULL : $dataArr['archive_remark'];
        if ($model->save())
            return $model->id;
            
            return false;
    }
    
    public static function getById($id)
    {
        return db('archive')->where('id', $id)->find();
    }
    
    public static function getByArchiveGroupId($id)
    {
        return db('archive')->where('archive_group_id', $id)->select();
    }
    
    public static function refresh($id, $dataArr)
    {
        $model = array();
        $model['archive_group_id'] = empty($dataArr['archive_group_id']) ? NULL : $dataArr['archive_group_id'];
        $model['archive_catalog'] = empty($dataArr['archive_catalog']) ? NULL : $dataArr['archive_catalog'];
        $model['archive_content'] = empty($dataArr['archive_content']) ? NULL : $dataArr['archive_content'];
        $model['archive_name'] = empty($dataArr['archive_name']) ? NULL : $dataArr['archive_name'];
        $model['archive_owner'] = empty($dataArr['archive_owner']) ? 0 : $dataArr['archive_owner'];
        $model['archive_remark'] = empty($dataArr['archive_remark']) ? NULL : $dataArr['archive_remark'];
        
        foreach ($model as $k => $v){
            if ($v == NULL) unset($model[$k]);
        }
        
        $effectRowId = db('archive')->where('id', $id)->update($model);
        if ($effectRowId)
            return $id;
            
            return false;
    }
    
    public static function remove($id)
    {
        $model = Archive::get($id);
        if (!empty($model))
            return $model->delete();
            return false;
    }
}