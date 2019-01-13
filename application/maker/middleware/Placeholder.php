<?php
namespace app\maker\middleware;

use think\Model;

class Placeholder {
    private $identity, $catalog, $name, $value, $remark;
    
    function __construct($value, $name, $catalog, $remark){
        $this->name = $name;
        $this->value = $value;
        $this->catalog = $catalog;
        $this->remark = $remark;
        $this->identity = $this->getIdentity();
        
    }
    
    public function changeName($name   ){
        $this->name = $name;
    }
        
    private function getIdentity(){
      return md5($this->name.$this->value.(microtime(true).toString));
    }
    
    public function add($placeholder){
        
    }
}