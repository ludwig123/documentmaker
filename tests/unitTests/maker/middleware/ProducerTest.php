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
    
    protected function setUp(){
        $this->producer = new Producer();
    }

    public function test_templetReplace_default_returnString(){
        $src = '{时间}，{时间}dsafa{驾驶人}{车牌}，放大{时间2}';
        $docInfo = array(
            0 => array(
                'name' => '驾驶人',
                'value' => '贺靖'
            ),
            1 => array(
                'name' => '车牌',
                'value' => '湘D0HT00'
            ),
            2 => array(
                'name' => '时间',
                'value' => '2019年3月6日'
            ),
        );
        
       $result = $this->producer->templetReplace($src, $docInfo);
       $this->assertContains('贺靖', $result );
       $this->assertContains('{时间2}', $result );
       $this->assertContains('2019年3月6日，2019年3月6日dsa', $result );
    }
    
    public function test_generateDoc_default_returnString(){

    }
    
    public function test_saveDocs_default_returnString(){

    }

}

