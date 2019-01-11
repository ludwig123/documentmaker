<?php
namespace app\maker\model;
use app\maker\model\iCURD;
use think\Model;

class User extends Model 
{
    public static function add($dataArr)
    {
        $user = new User;
        $user->username = $dataArr['username'];
        $user->password = $dataArr['password'];
        $user->mail = empty($dataArr['mail']) ? NULL : $dataArr['mail'];
        $user->phone = empty($dataArr['phone']) ? NULL : $dataArr['phone'];
        $user->status = empty($dataArr['status']) ? 1 : $dataArr['status'];
        if ($user->save())
            return $user->id;
            
            return false;
    }

    public static function getById($id)
    {
        return db('user')->where('id', $id)->find();
    }

    public static function refresh($id, $dataArr)
    {}

    public static function remove($id)
    {}

    
}