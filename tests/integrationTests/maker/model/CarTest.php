<?php
use app\maker\model\Car;
use PHPUnit\Framework\TestCase;

/**
 * Car test case.
 */
class CarTest extends TestCase
{

    /**
     *
     * @var Car
     */
    private $car;


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

}

