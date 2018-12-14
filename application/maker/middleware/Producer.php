<?php
namespace app\maker\middleware;

use app\maker\model\Archive;
use app\maker\model\ArchiveSuit;
use app\maker\model\TempletDoc;
use app\maker\model\TempletSuit;

class Producer{
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
}