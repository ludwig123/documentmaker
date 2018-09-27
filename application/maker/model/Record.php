<?php
namespace app\maker\model;

use think\Model;

class Record extends Model
{

    public function man(){
        return $this->hasOne('Man','identity','identity');
    }
    
    public function car(){
        return $this->hasOne('Car','car','car');
    }
    
    public function driver(){
        return $this->hasOne('Driver','identity','identity');
    }
    
    public function records(){
        
    }
}