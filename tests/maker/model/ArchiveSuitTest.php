<?php


/**
 * ArchiveSuit test case.
 */
use app\maker\model\ArchiveSuit;

class ArchiveSuitTest extends PHPUnit_Framework_TestCase
{

    protected static $id;
    /**
     */
    public function testAdd_default_returnId()
    {
        $data = ['archive_suit_catalog' => '人'
            ,'archive_suit_name' => '驾驶员姓名'
            ,'archive_suit_remark'=>'开车的那个人'
            ,'archive_suit_owner' => '1'
        ];
        
        self::$id = ArchiveSuit::add($data);
        $this->assertNotEquals(false, self::$id);
    }
    
    /**
     * @depends testAdd_default_returnId
     */
    public function testGetById_default_returnId()
    {
        $result = ArchiveSuit::getById(self::$id);
        $this->assertEquals(self::$id, $result['id']);
        
    }
    
    /**
     * @depends testAdd_default_returnId
     */
    public function testRefresh_default_returnId()
    {
        $data = ['archive_suit_catalog' => '人222'
            ,'archive_suit_name' => '驾驶员姓名'
            ,'archive_suit_remark'=>'开车的那个人啊啊啊啊'
            ,'archive_suit_owner' => '1'
        ];
        
        $effectId = ArchiveSuit::refresh(self::$id, $data);
        $this->assertEquals(self::$id, $effectId);
    }
    
    /**
     * @depends testAdd_default_returnId
     */
    public function testRemove_default_returnId()
    {
        $effectRow = ArchiveSuit::remove(self::$id);
        $this->assertEquals(1,$effectRow);
    }
}

