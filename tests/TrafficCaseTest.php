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
        $Id = '999';
        $case =  $this->trafficCase::findById($Id);
        $this->assertNull($case);
    }
    
    public function testFindById(){
        $id = '1';
        $case =  $this->trafficCase::findById($id);
        $this->assertCount(40, $case, "应该返回36个键值对");
    }

    public function testFindAll()
    {
        $cases = $this->trafficCase->all();
        $this->assertNotEmpty($cases);
        $this->assertEquals(1, $cases[0]['id']);
        $this->assertCount(2, $cases);
        
    }
    
    public function testUpdateUndefinedCase()
    {
        $data = array(
            'id' => '9999'
        );
        
       $id =  $this->trafficCase->update($data);
        $this->assertNull($id);
    }
    
    public function testUpdate()
    {
        $this->markTestIncomplete();
    }
    
}

