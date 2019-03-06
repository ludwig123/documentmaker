<?php
namespace app\maker\middleware;

use app\maker\model\Archive;
use app\maker\model\ArchiveSuit;
use app\maker\model\TempletDoc;
use app\maker\model\TempletSuit;

class Producer
{

    /**
     * 将案件的元素信息生成案件，并保存文档
     *
     * @param array $docInfo
     *            二维数组，需要含有 name="?" value="?"
     * @param int $templetSuitId
     * @return boolean | int 返回卷宗编号
     */
    public function saveDocs($docInfo, $templetSuitId, $owner)
    {
        $templets = $this->getTemplets($templetSuitId);
        $archiveSuitId = $this->addArchiveSuit($templetSuitId, $owner);

        $docs = $this->generateDocs($docInfo, $templets, $archiveSuitId);
     
        $docsCount = $this->addArchives($docs);

        if ($docsCount == count($templets)) {
            return $archiveSuitId;
        } else
            return false;
    }

    public function addArchiveSuit($templetSuitId, $owner)
    {
        $templetSuit = TempletSuit::getById($templetSuitId, NULL);
        $archiveSuit = $this->newArchiveSuit($templetSuit);
        $archiveSuitId = ArchiveSuit::add($archiveSuit, $owner);
        return $archiveSuitId;
    }
    
    public function addArchives($docs){
        $added = array();
        foreach ($docs as $k => $v) {
            $added[] = Archive::add($v);
        }
        return count($added);
    }

    /**把templetSuit 中的信息原封不动的存到 archiveSuit
     * @param array $templetSuit
     */
    public function newArchiveSuit($templetSuit)
    {
        $archiveSuit = array();
        $archiveSuit['archive_suit_catalog'] = $templetSuit['suit_catalog'];
        $archiveSuit['archive_suit_name'] = $templetSuit['suit_name'];
        $archiveSuit['archive_suit_remark'] = $templetSuit['suit_remark'];
        $archiveSuit['archive_suit_owner'] = $templetSuit['suit_owner'];
        return $archiveSuit;
    }

    public function newArchiveDocs($docInfo, $templetSuitId){
        
    }
    
    private function getTemplets($templetSuitId){
        return TempletDoc::getByGroupId($templetSuitId);
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
     * 生成单个文档array,用于数据库提交，不含groupId
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
     * 把字符串中{驾驶人}用array替换掉
     *
     * @param string $src
     *            模板文件 html 格式
     * @param array $docInfo
     * @return mixed
     */
    public function templetReplace($src, $docInfo)
    {
        
        $patterns = array();
        $replacements = array();
        $i = 0;
        foreach ($docInfo as $k => $info){
            $patterns[$i] = '/{'.$info['name'].'}/';
            $replacements[$i] = $info['value'];
            $i++;
        }
        
        return preg_replace($patterns, $replacements, $src);
    }

    public function getrr($docInfo, $templet)
    {
        // $patterns[0] = '/{'.$name.'}/';
        // $replacements[0] = $value;
    }
}