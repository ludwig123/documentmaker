<?php
use PHPUnit\Framework\TestCase;
use app\maker\model\TempletSuit;
use app\maker\middleware\Metas;


/**
 * TempletSuit test case.
 */
class TempletSuitTest extends TestCase
{

    protected static $id, $owner, $otherOwner;
    
    public function __construct()
    {
        parent::__construct();
        self::$owner = '0';
        self::$otherOwner = '999';
    }
    
    
    public function testAdd_default_returnId()
    {
        $data = ['suit_catalog' => '测试模板类别'
            ,'suit_name' => '集成测试模板名称'
            ,'suit_remark' => '测试模板套件备注'
            ,'suit_owner' => self::$owner
            ,'suit_metas' => 'i m  metas'
        ];
        
        self::$id = TempletSuit::add($data, self::$owner);
        $result = TempletSuit::getById(self::$id, self::$owner);
        $this->assertArraySubset($data, $result);
    }
    
    /**
     *@depends testAdd_default_returnId
     **/
    public function test_getById_Default_returnArr(){
        $result = TempletSuit::getById(self::$id, self::$owner);
        $this->assertEquals(self::$id, $result['id']);
    }
    
    /**
     *@depends testAdd_default_returnId
     **/
    public function test_getById_notOwned_returnNull(){
        $result = TempletSuit::getById(self::$id, self::$otherOwner);
        $this->assertEquals(NULL, $result);
    }
    
    
    
    
    /**
     *@depends testAdd_default_returnId
     **/
    public function testRefresh_default_returnId()
    {
        $data = ['suit_catalog' => '测试模板类别更新'
            ,'suit_name' => '集成测试模板名称更新'
            ,'suit_remark' => '测试模板套件备注更新'
            ,'suit_owner' => self::$owner
            ,'suit_metas' => 'fdafa'
        ];
        
        $effectId = TempletSuit::refresh(self::$id, $data, self::$owner);
        $result = TempletSuit::getById(self::$id, self::$owner);
        $this->assertArraySubset($data, $result);
        
    }
    
    /**
     *@depends testAdd_default_returnId
     **/
    public function testRefresh_othersSuit_returnFalse()
    {
        $data = ['suit_catalog' => '测试模板类别更新'
            ,'suit_name' => '集成测试模板名称更新'
            ,'suit_remark' => '测试模板套件备注更新'
            ,'suit_owner' => self::$owner
            ,'suit_metas' => 'fdafda'
        ];
        
        $effectId = TempletSuit::refresh(self::$id, $data, self::$otherOwner);
        $this->assertEquals(false, $effectId);
        
    }
    
    
    
    
    /**
     *@depends testAdd_default_returnId
     **/
    public function testRemove_othersSuit_returnFalse()
    {
        $effectRow = TempletSuit::remove(self::$id, self::$otherOwner);
        $this->assertEquals(false,$effectRow);

    }
    
    /**
     *@depends testAdd_default_returnId
     **/
    public function testRemove_default_returnId()
    {
        $effectRow = TempletSuit::remove(self::$id, self::$owner);
        $this->assertEquals(1,$effectRow);
        
        $result = TempletSuit::getById(self::$id, self::$owner);
        $this->assertEmpty($result);
    }
    
    
    public function test_getMetas_default(){
        $suit_id = '50';
        $owner = '0';
        $result = TempletSuit::getMetas($suit_id, $owner);
        
        $this->assertContains('i m  metas', $result);
        
    }
    
    public function test_addMeta_default(){
        
    }
    
    
    /**生成一个模拟的meta 数据
     * 
     */
    private function genarateMeta(){

    }
    
    
   

}

