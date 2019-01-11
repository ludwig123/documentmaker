<?php
namespace app\maker\model;

use think\Db;
use think\Model;

class TempletSuit extends Model implements iCURD
{
    public static function add($dataArr)
    {
        $suit = new TempletSuit;
        $suit->suit_catalog = empty($dataArr['suit_catalog']) ? NULL : $dataArr['suit_catalog'];
        $suit->suit_name = empty($dataArr['suit_name']) ? NULL : $dataArr['suit_name'];
        $suit->suit_owner = empty($dataArr['suit_owner']) ? 0 : $dataArr['suit_owner'];
        $suit->suit_remark = empty($dataArr['suit_remark']) ? 0 : $dataArr['suit_remark'];
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

    public static function refresh($id, $dataArr)
    {
        $suit = array();
        $suit['suit_catalog'] = empty($dataArr['suit_catalog']) ? NULL : $dataArr['suit_catalog'];
        $suit['suit_name'] = empty($dataArr['suit_name']) ? NULL : $dataArr['suit_name'];
        $suit['suit_owner'] = empty($dataArr['suit_owner']) ? NULL : $dataArr['suit_owner'];
        $suit['suit_remark'] = empty($dataArr['suit_remark']) ? NULL : $dataArr['suit_remark'];
        
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
    
    public static function getByOwner($ownerId){
        return db('templet_suit')->where('suit_owner ='.$ownerId)->select();
    }

    
}