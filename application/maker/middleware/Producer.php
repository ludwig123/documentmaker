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
     * @param array $docInfo
     * @param int $templetSuitId
     * @return boolean | int 返回卷宗编号
     */
    public function saveDocs($docInfo, $templetSuitId, $owner)
    {
        $templetSuit = TempletSuit::getById($templetSuitId, NULL);
        $archiveSuit = $this->getArchiveSuitFromTempletSuit($templetSuit);
        
        //怎么把模板的替换规则加进去
        $templets = TempletDoc::getByGroupId($templetSuitId);
        $archiveSuitId = ArchiveSuit::add($archiveSuit,$owner);       
        $docs = $this->generateDocs($docInfo, $templets, $archiveSuitId);
        
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
     * @param templetSuit
     */private function getArchiveSuitFromTempletSuit($templetSuit)
    {
        $archiveSuit = array();
        $archiveSuit['archive_suit_catalog'] = $templetSuit['suit_catalog'];
        $archiveSuit['archive_suit_name'] = $templetSuit['suit_name'];
        $archiveSuit['archive_suit_remark'] = $templetSuit['suit_remark'];
        $archiveSuit['archive_suit_owner'] = $templetSuit['suit_owner'];
        return $archiveSuit;
    }

    
    /**
     * 生成多个文档
     *
     * @param array $docInfo
     * @param array $templets
     * @param int $archiveSuitId
     * @return string[][]|mixed[][]
     */
    public function generateDocs($docInfo, $templets, $archiveSuitId)
    {
        $docs = array();
        foreach ($templets as $k => $templet) {
            $docs[] = $this->generateDoc($docInfo, $templet, $archiveSuitId);
        }
        return $docs;
    }
    
    /**
     * 生成一个文档array,用于数据库提交，不含groupId
     *
     * @param array $docInfo
     *            案件基本信息
     * @param string $templet
     *            模板
     * @return string[]|mixed[]
     */
    public function generateDoc($docInfo, $templet, $archiveSuitId)
    {
        $doc = array();
        $doc['archive_group_id'] = $archiveSuitId;
        $doc['archive_name'] = $templet['templet_name'];
        $doc['archive_catalog'] = $templet['templet_catalog'];
        $doc['archive_content'] = $this->templetReplace($templet['templet_content'], $docInfo);
        $doc['archive_owner'] = $templet['templet_owner'];
        $doc['archive_remark'] = $templet['templet_remark'];
        
        return $doc;
    }
    
    
    
    
    /**
     * 把字符串中的meta用array替换掉
     *
     * @param string $src 模板文件
     * @param array $docInfo
     * @return mixed
     */
    public function templetReplace($src, $docInfo)
    {
        $patterns = array();
        $replacements = array();
        
        // 驾驶员信息
        $patterns[0] = '/{驾驶证准驾车型}/';
        $replacements[0] = $docInfo['sex'];
        
        $patterns[1] = '/{驾驶员身份证}/';
        $replacements[1] = $docInfo['identity'];
        
        $patterns[2] = '/{驾驶员姓名}/';
        $replacements[2] = $docInfo['name'];
        
        $patterns[3] = '/{驾驶证档案编号}/';
        $replacements[3] = $docInfo['file_num'];
        
        $patterns[4] = '/{驾驶证发证机关}/';
        $replacements[4] = $docInfo['issuer'];
        
        $patterns[4] = '/{驾驶员手机号码}/';
        $replacements[4] = $docInfo['phone'];
        
        $patterns[4] = '/{驾驶员住址}/';
        $replacements[4] = $docInfo['address'];
        
        $patterns[4] = '/{驾驶员学历}/';
        $replacements[4] = $docInfo['education'];
        
        $patterns[4] = '/{驾驶员政治面貌}/';
        $replacements[4] = $docInfo['political'];
        
        $patterns[4] = '/{驾驶员公司}/';
        $replacements[4] = $docInfo['company'];
        
        $patterns[4] = '/{驾驶员国籍}/';
        $replacements[4] = $docInfo['nation'];
        
        $patterns[4] = '/{驾驶员籍贯}/';
        $replacements[4] = $docInfo['birth_place'];
        
        // 所驾车辆信息
        $patterns[5] = '/{车牌号}/';
        $replacements[5] = $docInfo['car_num'];
        
        $patterns[6] = '/{车辆类型}/';
        $replacements[6] = $docInfo['car_type'];
        
        $patterns[7] = '/{车辆所有人}/';
        $replacements[7] = $docInfo['car_owner'];
        
        // 违法信息
        $patterns[8] = '/{主办民警}/';
        $replacements[8] = $docInfo['police_1'];
        
        $patterns[9] = '/{协办民警}/';
        $replacements[9] = $docInfo['police_2'];
        
        $patterns[10] = '/{违法代码1}/';
        $replacements[10] = $docInfo['code_1'];
        
        $patterns[11] = '/{违法代码2}/';
        $replacements[11] = $docInfo['code_2'];
        
        $patterns[12] = '/{违法发生时间}/';
        $replacements[12] = $docInfo['time'];
        
        $patterns[121] = '/{违法发生地点}/';
        $replacements[121] = $docInfo['place'];
        
        $patterns[13] = '/{违法发现支队}/';
        $replacements[13] = $docInfo['zhidui'];
        
        $patterns[14] = '/{违法发现大队}/';
        $replacements[14] = $docInfo['dadui'];
        
        $patterns[15] = '/{开具的文书类型}/';
        $replacements[15] = $docInfo['doc_type'];
        
        $patterns[16] = '/{开具的文书编号}/';
        $replacements[16] = $docInfo['doc_index'];
        
        // 裁决信息
        $patterns[17] = '/{处罚决定书编号}/';
        $replacements[17] = $docInfo['index'];
        
        $patterns[18] = '/{违法裁决时间}/';
        $replacements[18] = $docInfo['judge_time'];
        
        $patterns[19] = '/{违法裁决支队}/';
        $replacements[19] = $docInfo['judge_zhidui'];
        
        $patterns[20] = '/{违法裁决大队}/';
        $replacements[20] = $docInfo['judge_dadui'];
        
        $patterns[21] = '/{违法证据}/';
        $replacements[21] = $docInfo['evidence'];
        
        return preg_replace($patterns, $replacements, $src);
    }
    
    public function getrr(){
        
    }
}