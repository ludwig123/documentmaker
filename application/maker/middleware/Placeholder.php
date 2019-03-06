<?php
namespace app\maker\middleware;


/**占位符用于在模板文件，供查找替换使用
 * @author ludwig
 *
 */
class Placeholder {
    //name 是占位符的名称，在模板中显示；value显示在最终文档中
    private $identity, $catalog, $name, $value, $remark;
    
    function __construct($value, $name, $catalog, $remark){
        $this->name = $name;
        $this->value = $value;
        $this->catalog = $catalog;
        $this->remark = $remark;
        $this->identity = $this->getIdentity();
        
    }
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function setCatalog($catalog){
        $this->catalog = $catalog;
    }
    
    public function setRemark($remark){
        $this->remark = $remark;
    }
    
    public function setValue($value){
        $this->value = $value;
    }
    
    
        
    /**为每个占位符分配一个唯一标识
     * @return string
     */
    private function getIdentity(){
      return md5($this->name.$this->value.(microtime(true).toString));
    }
    
    public function add($placeholder){
        
    }
}