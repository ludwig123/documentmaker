<?php
namespace app\maker\middleware;

class Meta{
    protected $name, $value, $identify;
    
    
    /**
     * @param string $name 显示的名称
     * @param string $value 显示的值
     */
    public function __construct($name, $value){
        $this->name = $name;
        $this->value = $value;
        $this->identify = md5($name.$value.microtime());
    }
    
    public function identify(){
        return $this->identify;
    }
    
    public function name(){
        return $this->name;
    }
    
    public function value(){
        return $this->value;  
    }
    
}