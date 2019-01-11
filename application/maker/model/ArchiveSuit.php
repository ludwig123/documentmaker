<?php
namespace app\maker\model;

use think\Model;
use PHPStan\Type\Traits\FalseyBooleanTypeTrait;

class ArchiveSuit extends Model implements iCURD
{

    public static function add($dataArr, $owner)
    {
        $model = new ArchiveSuit();
        $model->archive_suit_catalog = empty($dataArr['archive_suit_catalog']) ? NULL : $dataArr['archive_suit_catalog'];
        $model->archive_suit_name = empty($dataArr['archive_suit_name']) ? NULL : $dataArr['archive_suit_name'];
        $model->archive_suit_owner = $owner;
        $model->archive_suit_remark = empty($dataArr['archive_suit_remark']) ? NULL : $dataArr['archive_suit_remark'];
        if ($model->save())
            return $model->id;
        
        return false;
    }

    public static function getById($id, $owner)
    {
        return db('archive_suit')->where('id', $id)->where('archive_suit_owner', $owner)->find();
    }

    public static function getByRecordId($id, $owner)
    {
        return db('archive_suit')->where('record_id', $id)->where('archive_suit_owner', $owner)->find();
    }

    public static function refresh($id, $dataArr, $owner)
    {
        $archiveSuit = self::getById($id, $owner);
        if ($archiveSuit['archive_suit_owner'] != $owner){
            return false;
        }
        
        $model = array();
        $model['archive_suit_catalog'] = empty($dataArr['archive_suit_catalog']) ? NULL : $dataArr['archive_suit_catalog'];
        $model['archive_suit_name'] = empty($dataArr['archive_suit_name']) ? NULL : $dataArr['archive_suit_name'];
        $model['archive_suit_owner'] = $owner;
        $model['archive_suit_remark'] = empty($dataArr['archive_suit_remark']) ? NULL : $dataArr['archive_suit_remark'];
        
        foreach ($model as $k => $v) {
            if ($v == NULL)
                unset($model[$k]);
        }
        
        $effectRowId = db('archive_suit')->where('id', $id)->update($model);
        if ($effectRowId)
            return $id;
        
        return false;
    }

    /**删除一条记录
     * @param string $id
     * @return string|boolean
     */
    public static function remove($id, $owner)
    {
        $deletCount = db('archive_suit')->where('id', $id)
        ->where('archive_suit_owner', $owner)
        ->delete();
        
        if ($deletCount == 0){
            return false;
        }
        else {
            Archive::removeByGroupId($id);
            return $deletCount;
        }
    }

    public static function removeByRecordId($recordId, $owner)
    {
        $archiveSuit = db('archive_suit')->where('record_id', $recordId)->where('archive_suit_owner', $owner)->select();
        if (empty($archiveSuit))
            return false;
        
        $archiveSuitId = $archiveSuit['id'];
        
        //删除文档
        $num = db('archive')->where('archive_group_id', $archiveSuitId)->delete();
        if (empty($num))
            return false;
        
         //删除文档套件
        $num = db('archive_suit')->where('record_id', $recordId)->delete();
        if (empty($num))
            return false;
        
        return $num;
    }
}