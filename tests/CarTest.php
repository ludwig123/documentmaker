<?php
use app\maker\model\Car;

require_once 'application/maker/model/Car.php';

/**
 * Car test case.
 */
class CarTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Car
     */
    private $car;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated CarTest::setUp()
        
        $this->car = new Car();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated CarTest::tearDown()
        $this->car = null;
        
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
     * Tests Car->create()
     */
    public function testCreate()
    {
        $data = ['car_num' => '湘0HT09'
                ,'car_type' => '小型轿车'];
        
        $id = $this->car->add($data);
        $this->assertNotFalse($id);
        
        
        
        $data = ['car_num' => '湘0HT19'
            ,'car_type' => '小型轿车'];
        
        $id = $this->car->refresh($id, $data);
        
        $this->assertNotFalse($id);
        
        
    }

    /**
     * Tests Car->delete()
     */
    public function testDelete()
    {
        // TODO Auto-generated CarTest->testDelete()
        $this->markTestIncomplete("delete test not implemented");
        

    }
}

