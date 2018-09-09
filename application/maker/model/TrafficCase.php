<?php
namespace app\maker\model;

class TrafficCase {
    
    //决定书编号
    public function getDecisionNum(){
        $record = Record::where('decision_num',333)->find();
        return $record;
    }
    
    public function getDriverName(){
        
    }
}