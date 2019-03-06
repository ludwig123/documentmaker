<?php
namespace app\maker\middleware;

use app\maker\model\TempletSuit;

class TempletRepository{
    
    /**新增
     * @param string $suitId
     * @param array $data
     * @param string $owner
     */
    public function addMeta($suitId, $data, $owner){
       
        $suit = $this->getSuit($suitId, $owner);
        
        $metas = new Metas($suit['suit_metas']);
        
        $metas->add($data);
        
        $suit['suit_metas'] = $metas->serialize();
        
        return $this->refreshSuit($suitId, $suit, $owner);
        
    }
    
    /**删除一个meta
     * @param unknown $suitId
     * @param unknown $meta
     * @param unknown $owner
     */
    public function removeMeta($suitId, $meta, $owner){
        
    }
    
    public function refreshMeta($suitId, $meta, $owner){
        
    }
    
    /**对象形式返回metas, key 是 name
     * @param string $suitId
     */
    public function getMetas($suitId, $owner){
        $temp = TempletSuit::getMetas($suitId, $owner);
        $metas = new Metas($temp);
        return $metas;
    }
    
    public function getSuit($suitId, $owner){
        return TempletSuit::getById($suitId, $owner);
    }
    
    public function refreshSuit($suitId, $dataArr, $owner){
      return  TempletSuit::refresh($suitId, $dataArr, $owner);
    }
    
}