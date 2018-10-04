<?php
namespace app\maker\model;


use phpDocumentor\Reflection\DocBlock\Tags\Return_;

/**
 * @author ludwig
 *
 */
class TrafficCase {
    private $case;
    
    function __construct($index){
        $this->case = (new Record())->getRecordByIndex($index);
    }
    
    /**决定书编号
     * 
     */
    public function getIndex(){
        return $this->case['index'];
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
    
    public function getDaduiadui(){
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
        return $this->case['违法代码'];
    }
    
    public function getCode1Content(){
        return $this->case['违法内容'];
    }
    
    public function getCode1Against(){
        return $this->case['违法条款'];
    }
        
    public function getCode1Punish(){
        return $this->case['处罚依据'];
    }
    
    public function getCode1Money(){
        return $this->case['罚款金额'];
    }
    
    public function getCode2(){
        return $this->case['违法代码'];
    }
    
    public function getCode2Content(){
        return $this->case['违法内容'];
    }
    
    public function getCode2Against(){
        return $this->case['违法条款'];
    }
    
    public function getCode2Punish(){
        return $this->case['处罚依据'];
    }
    
    public function getCode2Money(){
        return $this->case['罚款金额'];
    }
        
        
        
        
        
}