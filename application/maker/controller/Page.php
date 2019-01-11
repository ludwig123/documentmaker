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

    public function footer()
    {
        return $this->fetch('maker@common/footer');
    }

    /**
     * 告知笔录
     *
     * @return mixed|string
     */
    public function gaozhibilu()
    {
        $id = getCurrentRecordId();
        if (empty($id)) {
            $this->error('请先选择一个案件！', 'records');
            ;
        }
        
        $data = TrafficCase::findById($id);
        
        $code_1 = $code_2 = array();
        if (! empty($data['code_1'])) {
            $code = Code::getDetail($data['code_1']);
            if (! empty($code)) {
                
                foreach ($code as $k => $v) {
                    $code_1[$k . '_1'] = $v;
                }
            }
        }
        if (! empty($data['code_2'])) {
            $code = Code::getDetail($data['code_2']);
            foreach ($code as $k => $v) {
                $code_2[$k . '_2'] = $v;
            }
        }
        
        $data = array_merge($data, $code_1, $code_2);
        
        if (! empty($data)) {
            $this->assign('data', $data);
        }
        
        $content = $punish = $activity = '';
        
        if (! empty($data['违法内容_2'])) {
            $content = '。' . $data['违法内容_2'] . '行为违反了' . $data['违法条款_2'] . '之规定，根据' . $data['处罚依据_2'] . '之规定，对你作出处罚';
            $punish = ';对你' . $data['违法内容_2'] . '的违法行为，给予罚款' . $data['罚款金额_2'] . '元的处罚;以上两项违法行为，分别裁决、合并执行拟给予你罚款？？？元的处罚';
            $activity = '，' . $data['违法内容_2'];
        }
        ;
        $this->assign('activity', $activity);
        $this->assign('punish', $punish);
        $this->assign('content', $content);
        return $this->fetch('gaozhibilu');
    }

    public function juedingshu()
    {
        $id = getCurrentRecordId();
        if (empty($id)) {
            $this->error('请先选择一个案件！', 'records');
            ;
        }
        $list = TrafficCase::findById($id);
        
        $code_1 = $code_2 = array();
        if (! empty($list['code_1'])) {
            $code = Code::getDetail($list['code_1']);
            if (! empty($code)) {
                foreach ($code as $k => $v) {
                    $code_1[$k . '_1'] = $v;
                }
            }
        }
        if (! empty($list['code_2'])) {
            $code = Code::getDetail($list['code_2']);
            foreach ($code as $k => $v) {
                $code_2[$k . '_2'] = $v;
            }
        }
        
        $list = array_merge($list, $code_1, $code_2);
        
        if (! empty($list)) {
            $this->assign('data', $list);
        }
        
        return $this->fetch('juedingshu');
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