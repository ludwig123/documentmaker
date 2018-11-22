<?php
namespace app\repo\model;

use think\Db;
use think\Model;

class TempletDoc extends Model
{
    public static function add($data){
       $id =  Db::table('templet_doc')->insertGetId($data);
       return $id;
    }
}