<?php
namespace app\maker\model;



use phpDocumentor\Reflection\DocBlock\Tags\Return_;

/**
 * @author ludwig
 *
 */
class TrafficCase {
    public $case;
    
    function __construct($id){
        $this->case = (new Record())->getRecordById($id);
    }
    
    /**决定书编号
     * 
     */
    public function getIndex(){
        return $this->case['index'];
    }
    
    public function getTime(){
        return $this->case['time'];
    }
    
    public function getPlace(){
        return $this->case['place'];
    }
        
    /**当事人名字
     * 
     */
    public function getName(){
        return $this->case['name'];
    }
    
    /**身份证号码
     * 
     */
    public function getIdentity(){
        return $this->case['identity'];
    }
    
    public function getZhidui(){
        return $this->case['zhidui'];
    }
    
    public function getDadui(){
        return $this->case['dadui'];
    }
    
    public function getEvidence(){
        return $this->case['evidence'];
    }
    
    public function getDocType(){
        return $this->case['doc_type'];
    }
    
    public function getPolice1(){
        return $this->case['police_1'];
    }
    
    public function getPolice2(){
        return $this->case['police_2'];
    }
    
    public function getSex(){
        return $this->case['sex'];
    }
    /**车牌号
     * 
     */
    public function getCar(){
        return $this->case['car'];
    }
    
    /**车辆类型
     * 
     */
    public function getCarType(){
        return $this->case['car_type'];
    }
    
    public function getPhone(){
        return $this->case['phone'];
    }
    
    public function getAddress(){
        return $this->case['address'];
    }
    public function getEducation(){
        return $this->case['education'];
    }
    
    /**工作单位
     * 
     */
    public function getCompany(){
        return $this->case['company'];
    }
    
    /**政治面貌
     * 
     */
    public function getPolitical(){
        return $this->case['political'];
    }
    
    /**档案编号
     * 
     */
    public function getFileNum(){
        return $this->case['file_num'];
    }
    
    /**发证机关
     * 
     */
    public function getIssuer(){
        return $this->case['issuer'];
    }
    
    /**准驾车型
     * 
     */
    public function getDriverType(){
        return $this->case['type'];
    }
    
    public function getCode1(){
        return $this->case['违法代码1'];
    }
    
    public function getCode1Content(){
        return $this->case['违法内容1'];
    }
    
    public function getCode1Against(){
        return $this->case['违法条款1'];
    }
        
    public function getCode1Punish(){
        return $this->case['处罚依据1'];
    }
    
    public function getCode1Money(){
        return $this->case['罚款金额1'];
    }
    
    public function getCode2(){
        return array_key_exists('code_2', $this->case)? NULL : $this->case['违法代码2'] ;
    }
    
    public function getCode2Content(){
        return array_key_exists('code_2', $this->case)? NULL :  $this->case['违法内容2'];
    }
    
    public function getCode2Against(){
        return array_key_exists('code_2', $this->case)? NULL : $this->case['违法条款2'];
    }
    
    public function getCode2Punish(){
        return array_key_exists('code_2', $this->case)? NULL : $this->case['处罚依据2'];
    }
    
    public function getCode2Money(){
        return array_key_exists('code_2', $this->case)? NULL : $this->case['罚款金额2'];
    }
        
        
}