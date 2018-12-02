<?php
namespace app\maker\controller;

use think\Controller;
use app\maker\model\TempletDoc;
use think\facade\Request;
use app\maker\model\TempletMetaLabel;


class Templet extends Controller
{
    public function editor($id = ''){
        if (empty($id)){
            clearCurrentTempletId();
        }
        setCurrentTempletId($id);
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
    
    public function detail(){
        return $this->fetch();
    }
    
    
    public function refresh(){
        $dataArr = Request::post();
        $id = getCurrentTempletId();
        if (empty($id)){
            $id = TempletDoc::add($data);
        }
        else {
            $id = TempletDoc::refresh($id,$dataArr);
        }
        

        if (empty($id)){
            return json("更新失败");
        }
        
        else return json("更新成功！");
    }
    
    public function list(){
        return  $this->fetch();
    }
    
}