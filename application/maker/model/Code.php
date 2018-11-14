<?php
namespace app\maker\model;

use think\Db;
use think\Model;

class Code extends Model
{
    /**
     * @param string $code
     * @return array|NULL
     */
    public static function getDetail($code){
        return Db::table('code')->where("违法代码=".$code)->find();
    }
    
    public static function getFullLaw($short){
        $patterns = array();
        $patterns[0] = '/《法》/';
        $patterns[1] = '/《办法》/';
        $patterns[2] = '/《条例》/';
        $replacements = array();
        $replacements[0] = '《中华人民共和国道路交通安全法》';
        $replacements[1] = '《湖南省实施〈中华人民共和国道路交通安全法〉办法》';
        $replacements[2] = '《中华人民共和国道路交通安全法实施条例》';
        
        return preg_replace($patterns, $replacements, $short);
        
    }
}