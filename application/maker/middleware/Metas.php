<?php
namespace app\maker\middleware;

use Serializable;

/**
 * @author ludwig
 *metas中name字段是唯一的
 *meta是value object
 */
class Metas implements Serializable{
    protected $metas = array();
    
    public function serialize()
    {
        return serialize($this->metas);
    }

    public function unserialize($serialized)
    {
        $this->metas = unserialize($serialized);
    }

    /**添加一个meta。如果存在该名字，就删除它再添加
     * @param Meta $meta
     */
    public function add(Meta $meta){
        if ($this->is_exist($meta)){
            $this->remove($meta);
        }
        
        $this->metas[$meta->name()] = $meta;
        
        return ;
    }
    
    //在更新一个meta的时候，需要把文档中所有用到的meta的display-name都更正过来！
    //暂时还未实现！！！
    public function refresh($meta){
        return $this->add($meta);
    }
    
    /**查找一个meta是否存在
     * @param Meta $meta
     * @return boolean
     */
    public function is_exist(Meta $meta){
        return array_key_exists($meta->name(), $this->metas);
    }
    
    /**删除一个 meta
     * @param Meta $meta
     */
    public function remove(Meta $meta){
        unset($this->metas[$meta->name()]);
        return ;
    }
    
    public function getMetas(){
        return $this->metas;
    }
    
    public function sortMetas(){
        $sortedMetas = array();
        foreach ($this->metas as $k => $v){
            
        }
    }
}