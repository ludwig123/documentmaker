<?php
use PHPUnit\Framework\TestCase;
use app\maker\model\TrafficCase;



/**
 * TrafficCase test case.
 */
class TrafficCaseTest extends TestCase
{

    /**
     *
     * @var TrafficCase
     */
    private $trafficCase;

    public function setUp(){
        $this->trafficCase = new TrafficCase();
    }
    
    public function tearDown(){
        $this->trafficCase = NULL;
    }

    /**
     * Tests TrafficCase->getDriverName()
     */
    public function testFindByUndefinedId()
    {
        $Id = '9999';
        $case =  $this->trafficCase::findById($Id);
        $this->assertNull($case);
    }
    
    public function testFindById(){
        $id = '1';
        $case =  $this->trafficCase::findById($id);
        $this->assertGreaterThan(38, count($case), "应该返回38个键值对");
    }

    public function testFindAll()
    {
        $cases = $this->trafficCase->all();
        $this->assertNotEmpty($cases);
        $this->assertEquals(1, $cases[0]['id']);
        
    }
    
    
    public function testRefresh()
    {
        $id = '1';
       $data = $this->trafficCase->findById($id);
    
    //改过去
    $data2 =  $data;
    $data2['index']='4304052900009777';
    $data2['code_2']= '11110';
    $data2['car_num'] = '浙D99999';
    $data2['file_num'] = '330220666777';
    $this->trafficCase->refresh($id, $data2);
    $data3 = $this->trafficCase->findById($id);
    
    
    
    $this->assertEquals(strval($data3['index']), '4304052900009777');
    $this->assertEquals($data3['code_2'], '11110');
    $this->assertEquals($data3['car_num'], '浙D99999');
    $this->assertEquals($data3['file_num'], '330220666777');
    
    
    //回复原状
    $this->trafficCase->refresh($id, $data);
    $this->assertEquals($data, $this->trafficCase->findById($id));
    
    
    }
    
    public function testRemove()
    {
        
    }
    
}

