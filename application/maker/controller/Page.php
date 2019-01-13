<?php
namespace app\maker\controller;

use app\maker\model\Code;
use app\maker\model\TempletDoc;
use app\maker\model\TempletSuit;
use app\maker\model\TrafficCase;
use think\Controller;
use think\facade\Request;
use app\maker\model\Archive;
use app\maker\model\ArchiveSuit;
use app\maker\middleware\Producer;

class Page extends BaseController
{
    public function __construct(){
        parent::__construct();
    }
    public function record($id = "")
    {

        if (empty($id)) {
            clearCurrentRecordId();
        } else
            setCurrentRecordId($id);
        
        return $this->fetch("form");
    }

    public function records()
    {

        return $this->fetch('recordslist');
    }


    public function editor()
    {
        $recordId = getCurrentRecordId();
        $archiveSuit = ArchiveSuit::getByRecordId($recordId, getUserId());
        $record = TrafficCase::findById($recordId);
        // 如果没有卷宗，需要生成卷宗
        if (empty($archiveSuit)) {
            $producer = new Producer();
            
            
            //暂时全部指定为模板套件1
            $templetSuitId = '1';
            
            
            
            $archiveSuitId = $producer->saveDocs($$record, $templetSuitId);
        } else {
            
            $archiveSuitId = $archiveSuit['id'];
            $archiveSuitCreatTime = $archiveSuit['create_time'];
            $recordIdUpdateTime = $record['update_time'];
           
        }
        
        
        setCurrentArchiveSuitId($archiveSuitId);
        $archives = Archive::getByArchiveGroupId($archiveSuitId);
        if (empty(getCurrentArchiveId()))
            setCurrentArchiveId($archives[0]['id']);
        $this->assign('archives', $archives);
        return $this->fetch();
    }

    public function refresh()
    {
        $dataArr = Request::post();
        $id = getCurrentArchiveId();
        if (empty($id)) {} else {
            $id = Archive::refresh($id, $dataArr);
        }
        
        if (empty($id)) {
            return json("更新失败");
        } 
        else{
            return json("更新成功！");
        }
    }
}