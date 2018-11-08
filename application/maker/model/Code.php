<?php
namespace app\maker\model;

use think\Db;
use think\Model;

class Code extends Model
{
    public static function getDetail($code){
        return Db::table('code')->where("违法代码=".$code)->find();
    }
}