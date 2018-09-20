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
        
        $this->trafficCase = new TrafficCase(/* parameters */);
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
    public function testGetDriverName()
    {
        // TODO Auto-generated TrafficCaseTest->testGetDriverName()
        $this->markTestIncomplete("getDriverName test not implemented");
        
        $this->trafficCase->getDriverName(/* parameters */);
    }

    /**
     * Tests TrafficCase->getCarNum()
     */
    public function testGetCarNum()
    {
        $this->assertTrue(false);
    }
}

