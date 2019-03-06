<?php
namespace app\maker\controller;

use app\maker\model\Code;
use think\facade\Request;
use app\maker\model\TempletSuit;
use app\maker\model\TrafficCase;
use app\maker\model\TempletDoc;
use app\maker\model\Archive;
use app\maker\model\ArchiveSuit;
use app\maker\model\Record;
use app\user\common\UserLogin;
use app\maker\model\TempletMetaLabel;
use app\maker\middleware\TempletRepository;

class Api extends BaseController
{
    private $owner;
    
    public function __construct(){
        parent::__construct();
        $this->owner = $this->getUserId();
    }
    
    public function code()
    {
        $code = Code::all();
        $list4LayUITable = $this->list4LayUITable($code);
        
        return json($list4LayUITable);
    }

    public function records()
    {
        $trafficCase = new TrafficCase();
        $records = $trafficCase->all($this->owner);
        
        $list4LayUITable = $this->list4LayUITable($records);
        
        return json($list4LayUITable);
    }

    /**
     * 通过决定书编号找到案卷所有信息
     *
     * @param $String $caseNum
     */
    public function record($id = '')
    {
        $id = getCurrentRecordId();
        if (empty($id))
            return json('');
            $case = TrafficCase::findById($id, $this->owner);
        // 不能直接返回json_encode是因为框架会自动给他套上json，根据请求类型转换为为html或json
        return json($case);
    }

    public function handleTrafficCase()
    {
        if (empty(getCurrentRecordId())) {
            $this->addTrafficCase();
        } else
            $this->refreshTrafficCase(getCurrentRecordId());
    }

    /**
     * 创建一个案卷
     *
     * @param Array $param
     */
    public function addTrafficCase()
    {
        $info = $this->postInfo();
        $case = new TrafficCase();
        $caseId = $case->add($info);
        if (empty($caseId))
            return json('添加失败');
        else {
            setCurrentRecordId($caseId);
            return json('添加成功！');
        }
    }
    
    public function addTempletSuit()
    {
        $info = $this->postInfo();
        $id = TempletSuit::add($info, $this->owner);
        if (empty($id))
            return json('添加失败');
            else {
                return json('添加成功！');
            }
    }


    /**
     * 更新案卷信息
     *
     * @param
     */
    public function refreshTrafficCase($id)
    {
        $info = $this->postInfo();
        if (empty($info))
            return;
        $case = new TrafficCase();
        $data = $case->refresh($id, $info);
        
        return json('更新成功！');
    }

    /**
     * 删除一个案卷
     *
     * @param
     *            $param
     */
    public function removeTrafficCase()
    {
        $info = $this->postInfo();
        $recordId = $info['id'];
        $case = new TrafficCase();
        $case->remove($recordId);
        
        $num = ArchiveSuit::removeByRecordId($recordId, $this->owner);
        if ($case != false) {
            return json('删除成功');
        }
        
        return json('删除失败');
    }
    
    public function removeTempletSuit()
    {
        $info = $this->postInfo();
        $templetSuitId = $info['id'];
        $userId = session('user');
        $id = TempletSuit::remove($templetSuitId, $userId['id']);
        
        if ($id != false) {
            return json('删除成功');
        }
        
        return json('删除失败,你无权删除该模板套件');
    }

    public function removeArchiveSuit()
    {
        $info = $this->postInfo();
        $record_id = $info['id'];
        $flag = true;
        
        //分两步，第一步是删除案件的信息
        //第二步，删除案件文档
        $flag = Record::remove($record_id, $this->owner);
        if ($flag == false) {
            return json('删除失败');
        }
        
        $flag = ArchiveSuit::removeByRecordId($record_id, $this->owner);
        if ($flag == false) {
            return json('删除失败');
        } else
            return json('删除成功');
    }

    /**获取违法代码的详细
     * @param string $code
     * @return \think\response\Json
     */
    public function getCodeDetail($code)
    {
        return json(Code::getDetail($code));
    }

    /**获取当前登陆用户的全部模板
     * @return \think\response\Json
     */
    public function tempLets()
    {
        $temp = TempletSuit::getByOwner($this->owner);
        $templets = array();
        foreach ($temp as $k => $v) {
            unset($v['suit_content']);
            $templets[] = $v;
        }
        
        $list4LayUITable = $this->list4LayUITable($templets);
        
        return json($list4LayUITable);

    }

    public function tempLetDetail()
    {
        $id = getCurrentTempletSuitId();
        $temp = TempletDoc::getByGroupId($id);
        $templets = $this->removeContentOfTemplets($temp);
        
        $list4LayUITable = $this->list4LayUITable($templets);
        
        return json($list4LayUITable);
    }

    public function refreshTemplet($id = '')
    {
        $info = $this->postInfo();
        $id = getCurrentRecordId();
        if (empty($id)) {
            TempletDoc::add($info);
            return json('新增成功！');
        } else {
            TempletDoc::refresh(getCurrentTempletId(), $info);
            return json('更新成功！');
        }
    }

    /**获取文档的具体内容，方法命名需要改一下
     * @return \think\response\Json|NULL
     */
    public function editorHTML()
    {
        $templetId = getCurrentTempletId();
        if (! empty($templetId)) {
            return json(TempletDoc::getById($templetId));
        } else
            return null;
    }

    private function postInfo()
    {
        if (Request::isPost())
            return Request::post();
    }


    public function getArchive($id = '')
    {
        if (empty($id))
            $id = getCurrentArchiveId();
        $data = Archive::getById($id);
        
        $list4LayUITable = $this->list4LayUITable($data);
        
        return json($list4LayUITable);
    }
    
    
    public function addMeta(){
        $templetSuitId = getCurrentTempletSuitId();
        
        $info = $this->postInfo();
        $templetRepo = new TempletRepository();
        $owner = $this->owner;
        $result = $templetRepo->addMeta($templetSuitId, $info, $owner); 
        
        if (empty($result)){
            return json('失败');
        }
        else {
            return json('成功');
        }
        
    }
    
    /**把数组列表转化成Layui table 要求的形式
     * @param array $dataArr
     * @param string $codeStatus
     * @return array
     */
    private function list4LayUITable($dataArr, $codeStatus = '0'){
       return array(
           'data' => $dataArr,
           'code' => $codeStatus,
          'count' => count($dataArr)
        );
    }
    
    private function getUserId(){
        $user = new UserLogin();
        return $user->id();
    }
    
    private function removeContentOfTemplets($templets){
        $temp = array();
        foreach ($templets as $k => $v) {
            unset($v['templet_content']);
            $temp[] = $v;
        }
        return $temp;
    }
}