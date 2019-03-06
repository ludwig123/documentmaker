<?php
namespace app\maker\controller;

use think\Controller;
use app\maker\model\TempletDoc;
use think\facade\Request;
use app\maker\model\TempletMetaLabel;
use app\maker\middleware\TempletRepository;


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
        
        $templetRepo = new TempletRepository();
        $suitId = getCurrentTempletSuitId();
        $owner = getUserId();
       $metas = $templetRepo->getMetas($suitId, $owner);
        $meta_labels = $metas->sort();

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
    
    
    public function list(){
        return  $this->fetch();
    }
    
    public function addSuit(){
        return $this->fetch();
    }
    
    
    
}