<?php
namespace app\maker\model;

use think\Db;
use think\Model;

class TempletSuit extends Model implements iCURD
{
    public static function add($dataArr, $owner)
    {
        $suit = new TempletSuit;
        $suit->suit_catalog = empty($dataArr['suit_catalog']) ? NULL : $dataArr['suit_catalog'];
        $suit->suit_name = empty($dataArr['suit_name']) ? NULL : $dataArr['suit_name'];
        $suit->suit_owner = $owner;
        $suit->suit_remark = empty($dataArr['suit_remark']) ? 0 : $dataArr['suit_remark'];
        $suit->suit_metas = empty($dataArr['suit_metas']) ? NULL : $dataArr['suit_metas'];
        if ($suit->save())
            return $suit->id;
            
            return false;
    }

    public static function getById($id, $owner)
    {
        if (empty($owner))
        return db('templet_suit')->where('id', $id)->find();
        
        else {
            return db('templet_suit')->where('id', $id)->where('suit_owner', $owner)->find();
        }
    }

    public static function refresh($id, $dataArr, $owner)
    {
        $suit = self::getById($id, $owner);
        if ($suit['suit_owner'] != $owner)
        {
            return false;
        }
        
        $suit = array();
        $suit['suit_catalog'] = empty($dataArr['suit_catalog']) ? NULL : $dataArr['suit_catalog'];
        $suit['suit_name'] = empty($dataArr['suit_name']) ? NULL : $dataArr['suit_name'];
        $suit['suit_owner'] = $owner;
        $suit['suit_remark'] = empty($dataArr['suit_remark']) ? NULL : $dataArr['suit_remark'];
        $suit['suit_metas'] = empty($dataArr['suit_metas']) ? NULL : $dataArr['suit_metas'];
        
        //去除未更新的字段
        foreach ($suit as $k => $v){
            if ($v == NULL) unset($suit[$k]);
        }
        $effectRow = Db::name('templet_suit')->where('id', $id)->update($suit);
        if ($effectRow)
            return $id;
            
            return false;
    }

    public static function remove($id, $owner)
    {
        $deletCount = db('templet_suit')->where('id', $id)
            ->where('suit_owner', $owner)
            ->delete();
        
        if ($deletCount == 0)
            return false;
        else {
            TempletDoc::removeByGroupId($id);
            return $deletCount;
        }
    }
    
    public static function getByOwner($owner){
        return db('templet_suit')->where('suit_owner', $owner)->select();
    }

    
}