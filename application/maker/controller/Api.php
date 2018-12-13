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
use think\Controller;

class Api extends Controller
{

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
            if (! is_police_login()) {
                $this->error('你还没有登陆！', '@user/Login');
            }
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
            // $info = $this->postInfo();
            // $case = new TrafficCase();
            // $caseId = $case->add($info);
            // if (empty($caseId))
            // return json('添加失败');
            
            // $templetSuitId = '1';
            // $archiveSuitId = $this->saveDocs($info, $templetSuitId);
            // if (empty($archiveSuitId))
            // return json('添加失败');
            
            // return json('添加成功！');
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

    /**
     * 将案件的元素信息生成案件，并保存文档
     *
     * @param array $info
     * @param int $templetSuitId
     * @return boolean | int 返回卷宗编号
     */
    public function saveDocs($info, $templetSuitId)
    {
        $templetSuit = TempletSuit::getById($templetSuitId);
        $templets = TempletDoc::getByGroupId($templetSuitId);
        
        $archiveSuit = array();
        $archiveSuit['archive_suit_catalog'] = $templetSuit['suit_catalog'];
        $archiveSuit['archive_suit_name'] = $templetSuit['suit_name'];
        $archiveSuit['archive_suit_remark'] = $templetSuit['suit_remark'];
        $archiveSuit['archive_suit_owner'] = $templetSuit['suit_owner'];
        
        $archiveSuitId = ArchiveSuit::add($archiveSuit);
        
        $docs = $this->generateDocs($info, $templets, $archiveSuitId);
        
        $added = array();
        foreach ($docs as $k => $v) {
            $added[] = Archive::add($v);
        }
        
        // 确保保存的案卷数和模板文件数量一致
        if (count($added) == count($templets)) {
            return $archiveSuitId;
        } else
            return false;
    }

    /**
     * 生成多个文档
     *
     * @param array $info
     * @param array $templets
     * @param int $archiveSuitId
     * @return string[][]|mixed[][]
     */
    public function generateDocs($info, $templets, $archiveSuitId)
    {
        $docs = array();
        foreach ($templets as $k => $t) {
            $docs[] = $this->generateDoc($info, $t, $archiveSuitId);
        }
        return $docs;
    }

    /**
     * 生成一个文档arr，不含groupId
     *
     * @param array $info
     *            案件基本信息
     * @param string $templet
     *            模板
     * @return string[]|mixed[]
     */
    public function generateDoc($info, $templet, $archiveSuitId)
    {
        $doc = array();
        $doc['archive_group_id'] = $archiveSuitId;
        $doc['archive_name'] = $templet['templet_name'];
        $doc['archive_catalog'] = $templet['templet_catalog'];
        $doc['archive_content'] = $this->templetReplace($templet['templet_content'], $info);
        $doc['archive_owner'] = $templet['templet_owner'];
        $doc['archive_remark'] = $templet['templet_remark'];
        
        return $doc;
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
        $case = new TrafficCase();
        $case->remove($info['id']);
        
        if ($case !== false) {
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

    public function tempLets2()
    {
        $temp = TempletDoc::getByOwner('0');
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

    public function tempLetDetail($id = '1')
    {
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

    /**
     * 把字符串中的meta用array替换掉
     *
     * @param string $str
     * @param array $record
     * @return mixed
     */
    public function templetReplace($str, $record)
    {
        $patterns = array();
        $replacements = array();
        
        // 驾驶员信息
        $patterns[0] = '/{驾驶证准驾车型}/';
        $replacements[0] = $record['sex'];
        
        $patterns[1] = '/{驾驶员身份证}/';
        $replacements[1] = $record['identity'];
        
        $patterns[2] = '/{驾驶员姓名}/';
        $replacements[2] = $record['name'];
        
        $patterns[3] = '/{驾驶证档案编号}/';
        $replacements[3] = $record['file_num'];
        
        $patterns[4] = '/{驾驶证发证机关}/';
        $replacements[4] = $record['issuer'];
        
        $patterns[4] = '/{驾驶员手机号码}/';
        $replacements[4] = $record['phone'];
        
        $patterns[4] = '/{驾驶员住址}/';
        $replacements[4] = $record['address'];
        
        $patterns[4] = '/{驾驶员学历}/';
        $replacements[4] = $record['education'];
        
        $patterns[4] = '/{驾驶员政治面貌}/';
        $replacements[4] = $record['political'];
        
        $patterns[4] = '/{驾驶员公司}/';
        $replacements[4] = $record['company'];
        
        $patterns[4] = '/{驾驶员国籍}/';
        $replacements[4] = $record['nation'];
        
        $patterns[4] = '/{驾驶员籍贯}/';
        $replacements[4] = $record['birth_place'];
        
        // 所驾车辆信息
        $patterns[5] = '/{车牌号}/';
        $replacements[5] = $record['car_num'];
        
        $patterns[6] = '/{车辆类型}/';
        $replacements[6] = $record['car_type'];
        
        $patterns[7] = '/{车辆所有人}/';
        $replacements[7] = $record['car_owner'];
        
        // 违法信息
        $patterns[8] = '/{主办民警}/';
        $replacements[8] = $record['police_1'];
        
        $patterns[9] = '/{协办民警}/';
        $replacements[9] = $record['police_2'];
        
        $patterns[10] = '/{违法代码1}/';
        $replacements[10] = $record['code_1'];
        
        $patterns[11] = '/{违法代码2}/';
        $replacements[11] = $record['code_2'];
        
        $patterns[12] = '/{违法发生时间}/';
        $replacements[12] = $record['time'];
        
        $patterns[121] = '/{违法发生地点}/';
        $replacements[121] = $record['place'];
        
        $patterns[13] = '/{违法发现支队}/';
        $replacements[13] = $record['zhidui'];
        
        $patterns[14] = '/{违法发现大队}/';
        $replacements[14] = $record['dadui'];
        
        $patterns[15] = '/{开具的文书类型}/';
        $replacements[15] = $record['doc_type'];
        
        $patterns[16] = '/{开具的文书编号}/';
        $replacements[16] = $record['doc_index'];
        
        // 裁决信息
        $patterns[17] = '/{处罚决定书编号}/';
        $replacements[17] = $record['index'];
        
        $patterns[18] = '/{违法裁决时间}/';
        $replacements[18] = $record['judge_time'];
        
        $patterns[19] = '/{违法裁决支队}/';
        $replacements[19] = $record['judge_zhidui'];
        
        $patterns[20] = '/{违法裁决大队}/';
        $replacements[20] = $record['judge_dadui'];
        
        $patterns[21] = '/{违法证据}/';
        $replacements[21] = $record['evidence'];
        
        return preg_replace($patterns, $replacements, $str);
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