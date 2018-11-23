<?php
use app\maker\model\TrafficCase;



/**
 * TrafficCase test case.
 */
class TrafficCaseTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var TrafficCase
     */
    private $trafficCase;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated TrafficCaseTest::setUp()
        
        $this->trafficCase = new TrafficCase('1');
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated TrafficCaseTest::tearDown()
        $this->trafficCase = null;
        
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
     * Tests TrafficCase->getDecisionNum()
     */
    public function testGetDecisionNum()
    {
        // TODO Auto-generated TrafficCaseTest->testGetDecisionNum()
        $this->markTestIncomplete("getDecisionNum test not implemented");
        
        $this->trafficCase->getDecisionNum(/* parameters */);
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

