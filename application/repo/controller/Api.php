<?php
namespace app\repo\controller;

use \think\Controller;
use think\Db;
use think\facade\Request;
use app\repo\model\TempletDoc;

class Api extends Controller
{
    public function getTemplets(){
        
    }
    
    public function submitTemplet(){
        $data = Request::post();
        
        $id = TempletDoc::add($data);
        
        if (empty($id)){
            return json("插入失败");
        }
        
        else return json("新增成功！");
    }
}