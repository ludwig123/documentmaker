<?php
use app\maker\model\Record;

require_once 'application/maker/model/Record.php';

/**
 * Record test case.
 */
class RecordTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Record
     */
    private $record;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated RecordTest::setUp()
        
        $this->record = new Record(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated RecordTest::tearDown()
        $this->record = null;
        
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
     * Tests Record->man()
     */
    public function testMan()
    {
        // TODO Auto-generated RecordTest->testMan()
        $this->markTestIncomplete("man test not implemented");
        
        $this->record->man(/* parameters */);
    }

    /**
     * Tests Record->car()
     */
    public function testCar()
    {
        // TODO Auto-generated RecordTest->testCar()
        $this->markTestIncomplete("car test not implemented");
        
        $this->record->car(/* parameters */);
    }

    /**
     * Tests Record->driver()
     */
    public function testDriver()
    {
        // TODO Auto-generated RecordTest->testDriver()
        $this->markTestIncomplete("driver test not implemented");
        
        $this->record->driver(/* parameters */);
    }

    /**
     * Tests Record->code_1()
     */
    public function testCode_1()
    {
        // TODO Auto-generated RecordTest->testCode_1()
        $this->markTestIncomplete("code_1 test not implemented");
        
        $this->record->code_1(/* parameters */);
    }

    /**
     * Tests Record->code_2()
     */
    public function testCode_2()
    {
        // TODO Auto-generated RecordTest->testCode_2()
        $this->markTestIncomplete("code_2 test not implemented");
        
        $this->record->code_2(/* parameters */);
    }

    /**
     * Tests Record->getDetail()
     */
    public function testGetDetail_IdNotExist_ReturnNull()
    {
        $this->assertNull(Record::getDetail('999999'));
    }

    public function testGetDetail_Default_ReturnArray()
    {
        $id = '1';
        $result  = Record::getDetail($id);
        $this->assertEquals('1',$result['id']);
    }
    

    /**
     * Tests Record->addRecord()
     */
    public function testAddRecord()
    {
        $data = ['name' => '陶怡瑾22'
            ,'identity' => '430444198912222222'
            ,'car_num' => '湘D8888'  //car
            ,'file_num' =>'4224110000'
            ,'name' => '陶一斤'
            ,'sex' => '女'
            ,'index' => '435405000029018'
        ];
        
        $id = Record::add($data);
        $this->assertNotFalse($id);
        
        
        
        $data = ['name' => '陶怡瑾33'
            ,'identity' => '4304441989133333'
            ,'car_num' => '湘D8885'  //car
            ,'file_num' =>'4224113333'
            ,'name' => '陶一斤'
            ,'sex' => '女'
            ,'index' => '435405000029014'
        ];
        
        
        $id = Record::refresh($id, $data);
        $this->assertNotFalse($id);
        
        $this->assertNotFalse(Record::remove($id));
        
    }
}

