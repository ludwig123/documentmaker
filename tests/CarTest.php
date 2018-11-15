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


    public function testAdd()
    {
        $data = ['car_num' => '湘0HT09'
                ,'car_type' => '小型轿车'];
        
        $id = Car::add($data);
        $this->assertNotFalse($id);
        
      
        
        $data = ['car_num' => '湘0HT13'
            ,'car_type' => '小型轿车'];
        
        $id = Car::refresh($id, $data);
        $this->assertNotFalse($id);
        
        $this->assertNotFalse(Car::remove($id));
        
        
    }

    public function testRemove()
    {
        // TODO Auto-generated CarTest->testDelete()
        $this->markTestIncomplete("delete test not implemented");
        

    }
}

