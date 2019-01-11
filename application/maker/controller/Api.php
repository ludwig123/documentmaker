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

class Api extends BaseController
{

    public function __construct(){
        parent::__construct();
    }
    
    public function code()
    {
        $code = Code::all();
        $data = array(
            'data' => $code,
            'code' => '0',
            'count' => count($code)
        );
        
        return json($data);
    }

    public function records()
    {
        $trafficCase = new TrafficCase();
        $records = $trafficCase->all();
        
        $response = array(
            'data' => $records,
            'code' => '0',
            'count' => count($records)
        );
        return json($response);
    }

    /**
     * 通过决定书编号找到案卷所有信息
     *
     * @param $String $caseNum
     */
    public function record($id = '')
    {
//             if (! is_police_login()) {
//                 $this->error('你还没有登陆！', '@user/Login');
//             }
        $id = getCurrentRecordId();
        if (empty($id))
            return json('');
        $case = TrafficCase::findById($id);
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
        
        $id = TempletSuit::add($info);
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
        
        $num = ArchiveSuit::removeByRecordId($recordId);
        if ($case != false) {
            return json('删除成功');
        }
        
        return json('删除失败');
    }
    
    public function removeTempletSuit()
    {
        $info = $this->postInfo();
        $id = TempletSuit::remove($info['id']);
        
        if ($id != false) {
            return json('删除成功');
        }
        
        return json('删除失败');
    }

    public function removeArchiveSuit()
    {
        $info = $this->postInfo();
        $record_id = $info['id'];
        $flag = true;
        $flag = Record::remove($record_id);
        if ($flag == false) {
            return json('删除失败');
        }
        
        $flag = ArchiveSuit::removeByRecordId($record_id);
        if ($flag == false) {
            return json('删除失败');
        } else
            return json('删除成功');
    }

    public function getCodeDetail($code)
    {
        return json(Code::getDetail($code));
    }

    public function tempLets()
    {
        $temp = TempletSuit::getByOwner('0');
        $templets = array();
        foreach ($temp as $k => $v) {
            unset($v['suit_content']);
            $templets[] = $v;
        }
        $response = array(
            'data' => $templets,
            'code' => '0',
            'count' => count($templets)
        );
        return json($response);
    }

    public function tempLetDetail()
    {
        $id = getCurrentTempletSuitId();
        $temp = TempletDoc::getByGroupId($id);
        $templets = array();
        foreach ($temp as $k => $v) {
            unset($v['templet_content']);
            $templets[] = $v;
        }
        $response = array(
            'data' => $templets,
            'code' => '0',
            'count' => count($templets)
        );
        return json($response);
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
        $response = array(
            'data' => $data,
            'code' => '0',
            'count' => count($data)
        );
        return json($response);
    }
}