<?php
namespace app\maker\model;

use think\Db;
use think\Model;

class TempletSuit extends Model implements iCURD
{
    public function add($dataArr)
    {
        $suit = new TempletSuit;
        $suit->suit_catalog = empty($dataArr['suit_catalog']) ? NULL : $dataArr['suit_catalog'];
        $suit->suit_name = empty($dataArr['suit_name']) ? NULL : $dataArr['suit_name'];
        $suit->suit_content = empty($dataArr['suit_content']) ? NULL : $dataArr['suit_content'];
        $suit->suit_owner = empty($dataArr['suit_owner']) ? 0 : $dataArr['suit_owner'];
        if ($suit->save())
            return $suit->id;
            
            return false;
    }

    public function getById($id)
    {
        return db('templet_suit')->where('id', $id)->find();
    }

    public function refresh($id, $dataArr)
    {
        $suit = array();
        $suit['suit_catalog'] = empty($dataArr['suit_catalog']) ? NULL : $dataArr['suit_catalog'];
        $suit['suit_name'] = empty($dataArr['suit_name']) ? NULL : $dataArr['suit_name'];
        $suit['suit_content'] = empty($dataArr['suit_content']) ? NULL : $dataArr['suit_content'];
        $suit['suit_owner'] = empty($dataArr['suit_owner']) ? NULL : $dataArr['suit_owner'];
        
        foreach ($suit as $k => $v){
            if ($v == NULL) unset($suit[$k]);
        }
        $effectRow = Db::name('templet_suit')->where('id', $id)->update($suit);
        if ($effectRow)
            return $id;
            
            return false;
    }

    public function remove($id)
    {
        $obj = TempletSuit::get($id);
        if (!empty($obj))
            return $obj->delete();
            return false;
    }

    
}