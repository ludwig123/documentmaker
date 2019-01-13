<?php
use app\maker\middleware\Producer;
use app\maker\model\TempletDoc;
use app\maker\model\TrafficCase;
use PHPUnit\Framework\TestCase;

/**
 * Producer test case.
 */
class ProducerTest extends TestCase
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
        
    }


    public function test_templetReplace_default_returnString(){
        $src = TempletDoc::getById('4');
        $case = new TrafficCase();
        $record = $case->findById('1');
        $producer = new Producer();
        $dest = $producer->templetReplace($src['templet_content'], $record);
        
        $this->assertContains("陶大暴", $dest);
        $this->assertNotContains("{", $dest);
    }
    
    public function test_generateDoc_default_returnString(){
        $info = TrafficCase::findById('1', getUserId());
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

