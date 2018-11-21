<?php

namespace app\maker\model;

use think\Db;
use think\Model;

class DocRepository
{
    
    /**获取一本半卷
     * 
     */
    public function getDoc($id){
        
    }
    
    /**获取案卷列表
     * @param string $id
     */
    public function getDocs($user_id){
        
    }
    
    public function searchByName(){
        
    }
    
    /**获取用户的模板套装列表
     * @param string $user_id
     */
    public function getTempletSuits($user_id){
        
    }
    
    /**获取用户某模板套装的模板列表
     * @param string $suit_id
     */
    public function getTempletSuit($user_id, $suit_id){
        
    }
}