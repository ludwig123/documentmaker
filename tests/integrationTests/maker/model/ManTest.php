<?php
use PHPUnit\Framework\TestCase;
use app\maker\model\Man;

require_once 'application/maker/model/Man.php';

/**
 * Man test case.
 */
class ManTest extends TestCase
{

    /**
     *
     * @var Man
     */
    private $man;


    /**
     * Tests Man::add()
     */
    public function testAdd()
    {
        $data = ['name' => '陶怡瑾22'
            ,'identity' => '430444198912222222'
            ,'car_num' => '湘D8888'
        ];
        
        $id = Man::add($data);
        $this->assertNotFalse($id);
        
        
        
        $data = ['name' => '陶怡瑾99'
            ,'identity' => '430444198912222222'];
        
        $id = Man::refresh($id, $data);
        $this->assertNotFalse($id);
        
         $this->assertNotFalse(Man::remove($id));
    }

    /**
     * Tests Man->refresh()
     */
    public function testRefresh()
    {
        // TODO Auto-generated ManTest->testRefresh()
        $this->markTestIncomplete("refresh test not implemented");
        
        $this->man->refresh(/* parameters */);
    }

    /**
     * Tests Man->remove()
     */
    public function testRemove()
    {
        // TODO Auto-generated ManTest->testRemove()
        $this->markTestIncomplete("remove test not implemented");
        
        $this->man->remove(/* parameters */);
    }
}

