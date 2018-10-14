<?php
use app\maker\controller\Api;

require_once 'application/maker/controller/Api.php';

/**
 * Api test case.
 */
class ApiTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Api
     */
    private $api;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated ApiTest::setUp()
        
        $this->api = new Api();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated ApiTest::tearDown()
        $this->api = null;
        
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
     * Tests Api->code()
     */
    public function testCode()
    {
        // TODO Auto-generated ApiTest->testCode()
        $this->markTestIncomplete("code test not implemented");
        
        $this->api->code(/* parameters */);
    }



    /**
     * Tests Api->record()
     */
    public function testRecord()
    {      
        $id = 1;
        $response = $this->api->record($id);
        
        $this->assertNotEmpty($response);
    }

    /**
     * Tests Api->newCase()
     */
    public function testNewCase()
    {
        // TODO Auto-generated ApiTest->testNewCase()
        $this->markTestIncomplete("newCase test not implemented");
        
        $this->api->newCase(/* parameters */);
    }

    /**
     * Tests Api->updateCase()
     */
    public function testUpdateCase()
    {
        // TODO Auto-generated ApiTest->testUpdateCase()
        $this->markTestIncomplete("updateCase test not implemented");
        
        $this->api->updateCase(/* parameters */);
    }

    /**
     * Tests Api->deleteCase()
     */
    public function testDeleteCase()
    {
        // TODO Auto-generated ApiTest->testDeleteCase()
        $this->markTestIncomplete("deleteCase test not implemented");
        
        $this->api->deleteCase(/* parameters */);
    }
}

