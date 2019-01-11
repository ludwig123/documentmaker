<?php
namespace app\maker\controller;

use think\Controller;
use app\maker\model\TempletDoc;
use think\facade\Request;
use app\maker\model\TempletMetaLabel;


class Templet extends BaseController
{
    public function __construct(){
        parent::__construct();
    }
    public function editor($id = ''){
        if (empty($id)){
            clearCurrentTempletId();
        }
        else {
            setCurrentTempletId($id);
        }
        
        $catalogs = TempletDoc::getCatalogArr();
        $this->assign('catalogs', $catalogs);
        
        $temp= TempletMetaLabel::getMetaArr();
        $meta_labels = array();
        foreach ($temp as $k=>$v){
            $meta_labels[$v['templet_meta_attr']][] = $v;
        }
        $this->assign('meta_labels', $meta_labels);
       return $this->fetch();
    }
    
    public function index(){
      return  $this->fetch();
    }
    
    public function detail($id){
        setCurrentTempletSuitId($id);
        return $this->fetch();
    }
    
    
    public function refreshTempletDoc(){
        $dataArr = Request::post();
        $templetSuitId = getCurrentTempletSuitId();
        $templetDocId = getCurrentTempletId();
        //新增模板文件
        if (empty($templetDocId)){
            $dataArr['templet_group_id'] = $templetSuitId;
            $templetDocId = TempletDoc::add($dataArr);
        }
        else {
            $templetDocId = TempletDoc::refresh($templetDocId,$dataArr);
        }
        

        if (empty($templetDocId)){
            return json("更新失败");
        }
        
        else return json("更新成功！");
    }
    
    public function list(){
        return  $this->fetch();
    }
    
    public function addSuit(){
        return $this->fetch();
    }
    
}