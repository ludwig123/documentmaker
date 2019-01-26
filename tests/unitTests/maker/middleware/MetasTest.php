<?php
use PHPUnit\Framework\TestCase;
use app\maker\middleware\Metas;


require_once 'application/maker/middleware/Metas.php';

/**
 * Metas test case.
 */
class MetasTest extends TestCase
{

    /**
     *
     * @var Metas
     */
    private $metas, $meta;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->metas = new Metas();

        $name = '驾驶员';
        $value = '李大嘴';
        $remark = '我是备注';
        $catalog = '交管';
        
        $this->meta = array(
            'name' => $name,
            'catalog' => $catalog,
            'remark' => $remark,
            'value' => $value
        );
        
        $this->metas->add($this->meta);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->metas = null;
        
        parent::tearDown();
    }

    public function testSerialize()
    {
        
       $result = $this->metas->serialize();
       $this->assertContains('李大嘴', $result);
       $this->assertContains('驾驶员', $result);
    }


    public function testUnserialize()
    {
        $result = $this->metas->serialize();
        $obj = $this->metas->unserialize($result);
        $this->assertTrue($this->metas->is_exist($this->meta['name']));
    }


    public function testAdd_default()
    {
        
        $this->assertTrue($this->metas->is_exist($this->meta['name']));
    }

    
    public function test_getMetas_defualt_return_arrays(){
        $metas = $this->metas->getMetas();
        $this->assertEquals(1, count($metas));
    }
    
 
    
    public function test_refesh_change_name(){
        $destValue = '驾驶员2';
        $this->meta['name'] = $destValue;
        
        $this->metas->refresh($this->meta);
        $this->assertContains('驾驶员2', $this->metas->serialize());
        
    }


    public function testRemove_default()
    {   
        $this->metas->remove($this->meta['name']);
        $this->assertFalse($this->metas->is_exist($this->meta['name']));
    }
}

