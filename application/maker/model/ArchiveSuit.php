<?php
namespace app\maker\model;

use think\Model;

class ArchiveSuit extends Model implements iCURD
{

    public static function add($dataArr)
    {
        $model = new ArchiveSuit();
        $model->archive_suit_catalog = empty($dataArr['archive_suit_catalog']) ? NULL : $dataArr['archive_suit_catalog'];
        $model->archive_suit_name = empty($dataArr['archive_suit_name']) ? NULL : $dataArr['archive_suit_name'];
        $model->archive_suit_owner = empty($dataArr['archive_suit_owner']) ? 0 : $dataArr['archive_suit_owner'];
        $model->archive_suit_remark = empty($dataArr['archive_suit_remark']) ? NULL : $dataArr['archive_suit_remark'];
        if ($model->save())
            return $model->id;
        
        return false;
    }

    public static function getById($id)
    {
        return db('archive_suit')->where('id', $id)->find();
    }

    public static function getByRecordId($id)
    {
        return db('archive_suit')->where('record_id', $id)->find();
    }

    public static function refresh($id, $dataArr)
    {
        $model = array();
        $model['archive_suit_catalog'] = empty($dataArr['archive_suit_catalog']) ? NULL : $dataArr['archive_suit_catalog'];
        $model['archive_suit_name'] = empty($dataArr['archive_suit_name']) ? NULL : $dataArr['archive_suit_name'];
        $model['archive_suit_owner'] = empty($dataArr['archive_suit_owner']) ? 0 : $dataArr['archive_suit_owner'];
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
    public static function remove($id)
    {
        $model = ArchiveSuit::get($id);
        if (! empty($model)) {
//             db('archive')->where('archive_group_id', $id)->delete();
            Archive::removeByGroupId($id);
            return $model->delete();
        }
        
        return false;
    }

    public static function removeByRecordId($recordId)
    {
        $archiveSuit = db('archive_suit')->where('record_id', $recordId)->select();
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