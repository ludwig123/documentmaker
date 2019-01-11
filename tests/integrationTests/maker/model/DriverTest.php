<?php
use PHPUnit\Framework\TestCase;
use app\maker\model\Driver;

require_once 'application/maker/model/Driver.php';

/**
 * Driver test case.
 */
class DriverTest extends TestCase
{

    /**
     *
     * @var Driver
     */
    private $driver;


    /**
     * Tests Driver::add()
     */
    public function testAdd()
    {

        $data = ['file_num' => '430400123456'
            ,'identity' => '430444198912222222'
            ,'car_num' => '湘D8888'
        ];
        
        $id = Driver::add($data);
        $this->assertNotFalse($id);
        
        
        
        $data = ['file_num' => '430400123466'
            ,'identity' => '430444198912222222'];
        
        $id = Driver::refresh($id, $data);
        $this->assertNotFalse($id);
        
        $this->assertNotFalse(Driver::remove($id));
    }

    /**
     * Tests Driver->refresh()
     */
    public function testRefresh()
    {
        // TODO Auto-generated DriverTest->testRefresh()
        $this->markTestIncomplete("refresh test not implemented");
        
        $this->driver->refresh(/* parameters */);
    }

    /**
     * Tests Driver->remove()
     */
    public function testRemove()
    {
        // TODO Auto-generated DriverTest->testRemove()
        $this->markTestIncomplete("remove test not implemented");
        
        $this->driver->remove(/* parameters */);
    }
}

