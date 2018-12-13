<?php
namespace app\repo\controller;

use \think\Controller;
use think\Db;
use think\facade\Request;
use app\repo\model\TempletDoc;

class Api extends Controller
{
    
    //模板套装部分
    /**获取自己的所有套装
     *@return array;套装的标题，分类，修改时间
     */
    public function getTempletSuits(){
        
        return array();
    }
    
    
    /**获取自己的指定套装
     *@return array 由多个模板简略组成的
     */
    public function getTempletSuit($suitId){
        
    }
    
    
    
    //模板部分
    /**获取自己的所有模板
     * @return array 由所有模板简略组成的
     */
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