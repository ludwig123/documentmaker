<?php
namespace app\maker\model;

class TrafficCaseFactory{
    public static function getById($Id){
        return new TrafficCase($Id, 'Id');
    }
    
    public static function getByIndex($index){
        return new TrafficCase($index, 'index');
    }
    
    
    public static function new($case){
        return new TrafficCase($case, 'new');
    }
    
    public static function update($case){
        return new TrafficCase();
    }
    
}