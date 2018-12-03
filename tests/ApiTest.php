<?php
use app\maker\controller\Api;
use app\maker\model\TrafficCase;
use app\maker\model\TempletDoc;

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
    
    public function test_templetReplace_default_returnString(){
        $src = TempletDoc::getById('4');
        $case = new TrafficCase();
        $record = $case->findById('1');
        $dest = $this->api->templetReplace($src['templet_content'], $record);
        
        $this->assertContains("陶大暴", $dest);
        $this->assertNotContains("{", $dest);
        
    }
    
    public function test_generateDoc_default_returnString(){
        $info = TrafficCase::findById('1');
        $this->assertNotNull($info);
    }
    
    public function test_saveDocs_default_returnString(){
        
        $templetSuitId = '1';
        $case = new TrafficCase();
        $info = $case->findById('1');
       $archiveSuitId =  $this->api->saveDocs($info, $templetSuitId);
       $this->assertNotFalse($archiveSuitId);
    }



}

