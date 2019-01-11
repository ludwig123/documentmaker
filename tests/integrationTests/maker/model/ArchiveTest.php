<?php
use PHPUnit\Framework\TestCase;
use app\maker\model\Archive;


/**
 * Archive test case.
 */
class ArchiveTest extends TestCase
{

    protected static $id;
    /**
    */
    public function testAdd_default_returnId()
    {
        $data = ['archive_catalog' => '人'
            ,'archive_name' => '驾驶员姓名'
            ,'archive_content' => '我是测试的文档内容'
            ,'archive_remark'=>'开车的那个人'
            ,'archive_owner' => '1'
        ];
        
        self::$id = Archive::add($data);
        $this->assertNotEquals(false, self::$id);
    }
    
    /**
     * @depends testAdd_default_returnId
     */
    public function testGetById_default_returnId()
    {
        $result = Archive::getById(self::$id);
        $this->assertEquals(self::$id, $result['id']);
        
    }
    
    /**
     * @depends testAdd_default_returnId
     */
    public function testRefresh_default_returnId()
    {
        $data = ['archive_catalog' => '人'
            ,'archive_name' => '驾驶员姓名'
            ,'archive_content' => '我是测试的文档内容33333更新后的'
            ,'archive_remark'=>'开车的那个人啊啊啊啊'
            ,'archive_owner' => '1'
        ];
        
        $effectId = Archive::refresh(self::$id, $data);
        $this->assertEquals(self::$id, $effectId);
    }
    
    /**
     * @depends testAdd_default_returnId
     */
    public function testRemove_default_returnId()
    {
        $effectRow = Archive::remove(self::$id);
        $this->assertEquals(1,$effectRow);
    }
}

