<?php
use app\maker\model\Driver;

require_once 'application/maker/model/Driver.php';

/**
 * Driver test case.
 */
class DriverTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Driver
     */
    private $driver;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated DriverTest::setUp()
        
        $this->driver = new Driver(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated DriverTest::tearDown()
        $this->driver = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }

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

