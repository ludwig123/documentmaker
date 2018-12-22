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
    



}

