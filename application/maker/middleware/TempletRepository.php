<?php
namespace app\maker\middleware;

use app\maker\model\TempletSuit;
use phpDocumentor\Reflection\Types\This;

class TempletRepository{
    
    public function addMeta($suitId, $data, $owner){
        
       
        
        $suit = $this->getSuit($suitId, $owner);
        
        $metas = new Metas($suit['suit_metas']);
        
        $metas->add($meta);
        
        $suit['suit_metas'] = $metas->serialize();
        
        $this->update($suit);
        
    }
    
    public function removeMeta($suitId, $meta, $owner){
        
    }
    
    public function refreshMeta($suitId, $meta, $owner){
        
    }
    
    /**数组形式返回metas
     * @param string $suitId
     */
    public function getMetas($suitId, $owner){
        $temp = TempletSuit::getMetas($suit_id);
    }
    
    public function getSuit($suitId, $owner){
        return TempletSuit::getById($suitId, $owner);
    }
    
}