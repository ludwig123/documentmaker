<?php

/**
 * MetaLable test case.
 */

use app\maker\model\TempletMetaLabel;

class TempletMetaLableTest extends PHPUnit_Framework_TestCase
{


    
    protected static $id;
   

    /**
     * Tests MetaLable::add()
     */
    public function testAdd_default_returnId()
    {
        $data = ['templet_meta_catalog' => '人'
            ,'templet_meta_name' => '驾驶员姓名'
            ,'templet_meta_remark'=>'开车的那个人'
            ,'templet_meta_owner' => '1'
        ];
        
        self::$id = TempletMetaLabel::add($data);
        $this->assertNotEquals(false, self::$id);
    }

    /**
     * Tests MetaLable::getById()
     * @depends testAdd_default_returnId
     */
    public function testGetById_default_returnId()
    {
        $result = TempletMetaLabel::getById(self::$id);
        $this->assertEquals(self::$id, $result['id']);
        
    }

    /**
     * Tests MetaLable::refresh()
     * @depends testAdd_default_returnId
     */
    public function testRefresh_default_returnId()
    {
        $data = ['templet_meta_catalog' => '人'
            ,'templet_meta_name' => '驾驶员姓名'
            ,'templet_meta_remark'=>'开车的那个人啊啊啊啊'
            ,'templet_meta_owner' => '1'
        ];
        
        $effectId = TempletMetaLabel::refresh(self::$id, $data);
        $this->assertEquals(self::$id, $effectId);
    }

    /**
     * Tests MetaLable::remove()
     * @depends testAdd_default_returnId
     */
    public function testRemove_default_returnId()
    {
        $effectRow = TempletMetaLabel::remove(self::$id);
        $this->assertEquals(1,$effectRow);
    }
    
    public function testGetMetaLabelArr_withoutOwerId_returnArr(){
        $result = TempletMetaLabel::getMetaArr();
        $this->assertGreaterThan(2, count($result));
    }
}

