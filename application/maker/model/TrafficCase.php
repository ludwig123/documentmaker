<?php
namespace app\maker\model;

class TrafficCase {
    
    //决定书编号
    public function getDecisionNum(){
        $record = Record::where('decision_num',333)->find();
        return '3333';
    }
    
    public function getDriverName(){
        return '2';
    }
    
    public function getCarNum(){
        if (true){
            echo 'jjj';
        }
        
        return true;
    }
}