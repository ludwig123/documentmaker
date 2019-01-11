<?php

use app\maker\model\ArchiveSuit;
use PHPUnit\Framework\TestCase;

class ArchiveSuitTest extends TestCase
{
    protected static $id, $owner, $otherOwner;
    
    public function __construct()
    {
        parent::__construct();
        self::$owner = '0';
        self::$otherOwner = '999';
    }
    
    /**
     */
    public function testAdd_default_returnId()
    {
        $data = ['archive_suit_catalog' => '人'
            ,'archive_suit_name' => '驾驶员姓名'
            ,'archive_suit_remark'=>'开车的那个人'
        ];
        
        self::$id = ArchiveSuit::add($data, self::$owner);
        $this->assertNotEquals(false, self::$id);
    }
    
    /**
     * @depends testAdd_default_returnId
     */
    public function testGetById_default_returnId()
    {
        $result = ArchiveSuit::getById(self::$id, self::$owner);
        $this->assertEquals(self::$id, $result['id']);
        
    }
    
    /**
     * @depends testAdd_default_returnId
     */
    public function testGetById_notOwned_returnId()
    {
        $result = ArchiveSuit::getById(self::$id, self::$otherOwner);
        $this->assertEquals(false, $result);
        
    }
    
    
    
    
    /**
     * @depends testAdd_default_returnId
     */
    public function testRefresh_default_returnId()
    {
        $data = ['archive_suit_catalog' => '人更新'
            ,'archive_suit_name' => '驾驶员姓名更新'
            ,'archive_suit_remark'=>'开车的那个人更新'
        ];
        
        $effectId = ArchiveSuit::refresh(self::$id, $data, self::$owner);
        $this->assertEquals(self::$id, $effectId);
    }
    
    /**
     * @depends testAdd_default_returnId
     */
    public function testRefresh_notOwned_returnId()
    {
        $data = ['archive_suit_catalog' => '人更新'
            ,'archive_suit_name' => '驾驶员姓名更新'
            ,'archive_suit_remark'=>'开车的那个人更新'
        ];
        
        $effectId = ArchiveSuit::refresh(self::$id, $data, self::$otherOwner);
        $this->assertEquals(false, $effectId);
    }
    
    
    
    
    
    
    /**
     * @depends testAdd_default_returnId
     */
    public function testRemove_default_returnId()
    {
        $effectRow = ArchiveSuit::remove(self::$id, self::$owner);
        $this->assertEquals(1,$effectRow);
    }
    
    /**
     * @depends testAdd_default_returnId
     */
    public function testRemove_notOwned_returnId()
    {
        $effectRow = ArchiveSuit::remove(self::$id, self::$otherOwner);
        $this->assertEquals(false,$effectRow);
    }
}

