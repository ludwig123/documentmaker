<?php
namespace app\maker\middleware;


//这里作为一个值对象
class Meta{
    protected $name, $value, $identify, $remark, $catalog, $type;
    
    
    /**
     * @param string $name 显示的名称
     * @param string $value 显示的值
     */
    public function __construct($name, $value, $catalog, $remark = null){
        $this->name = $name;
        $this->value = $value;
        $this->catalog = $catalog;
        $this->remark = $remark;
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
    
    public function catalog(){
        return $this->catalog;
    }
    


    
}