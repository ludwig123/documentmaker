<?php
namespace app\maker\model;

use think\Db;
use think\Model;
use app\maker\middleware\Placeholder;

class Placeholders extends Model{
    
    
    public function add(Placeholder $placeholder, $templetSuitId){
        $holder = new Placeholders;
        $holder->catalog = $placeholder['catalog'];
        $holder->name = $placeholder['name'];
        $holder->templetSuitId = $templetSuitId;
        $holder->remark = $placeholder['remark'];
        if ($holder->save())
            return $holder->id;
            
            return false;
    }
    
    public static function refresh($id, $placeholder)
    {        
        $holder = array();
        $holder['catalog'] = empty($placeholder['catalog']) ? NULL : $placeholder['catalog'];
        $holder['name'] = empty($placeholder['name']) ? NULL : $placeholder['name'];
        $holder['remark'] = empty($placeholder['remark']) ? NULL : $placeholder['remark'];
        
        foreach ($holder as $k => $v){
            if ($v == NULL) unset($holder[$k]);
        }
        
        $effectRow = Db::name('placeholder')->where('id', $id)->update($holder);
        if ($effectRow)
            return $id;
            
            return false;
    }
    
    public function getByGroupId($groupId){
        return db('placeholder')->where('group_id', $groupId)->select();
    }
    
    
    public static function removeByGroupId($id){
        return db('placeholder')->where('group_id', $id)->delete();
    }
}