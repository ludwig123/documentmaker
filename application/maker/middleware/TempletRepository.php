<?php
namespace app\maker\middleware;

use app\maker\model\TempletSuit;

class TempletRepository{
    
    public function addMeta($suitId, $data){
        
        $meta = new Meta($data['name'], $data['value'], $data['catalog']);
        
        TempletSuit::addMeta($meta);
        
    }
    
    public function removeMeta($suitId, $meta){
        
    }
}