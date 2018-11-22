<?php
namespace app\repo\controller;

use \think\Controller;
use think\Db;
class Index extends Controller
{
    public function Index(){
        $type = config('database.query');
    $result = Db::table('archive_doc')
    ->where('id','5bf6608fafe2000878a17282')
    ->find();
    var_dump($result);
    }
}