<?php
use app\maker\controller\Api;
use app\maker\model\TrafficCase;

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
        $src = "2017年04月07日11时15分，湖南省衡南县冠市镇西头村上里组的{姓名}驾驶湘D22C08轻型仓栅式货车行至泉南高速公路801公里珠晖南收费站出口时,因实施未取得机动车驾驶证驾驶摩托车、拖拉机、营运载客汽车以外的机动车的违法行为，被我们当场查获。我们依法开具{性别}号《道路交通安全违法行为处理通知书》交付当事人，并通知当事人携带此凭证和相关合法手续15日内到湖南省高速公路交通警察局衡阳支队衡阳西大队接受处理。";
        $case = new TrafficCase();
        $record = $case->findById('1');
        $dest = $this->api->templetReplace($src, $record);
        
        $this->assertNotContains("{姓名}", $dest);
        
        
    }



}

