<?php
use app\maker\middleware\Producer;
use app\maker\model\TempletDoc;
use app\maker\model\TrafficCase;


/**
 * Producer test case.
 */
class ProducerTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Producer
     */
    private $producer;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {

        
        $this->producer = new Producer(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {

        $this->producer = null;
        
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
        $dest = $this->producer->templetReplace($src['templet_content'], $record);
        
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
        $archiveSuitId =  $this->producer->saveDocs($info, $templetSuitId);
        $this->assertNotFalse($archiveSuitId);
    }

}

