<?php
use PHPUnit\Framework\TestCase;
use app\maker\model\Record;

require_once 'application/maker/model/Record.php';

/**
 * Record test case.
 */
class RecordTest extends TestCase
{

    protected static $id, $owner, $otherOwner;
    
    public function __construct()
    {
        parent::__construct();
        self::$owner = '1';
        self::$otherOwner = '999';
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
    

    public function testAdd_default_returnId()
    {
        $data = ['name' => '陶怡瑾22'
            ,'identity' => '430444198912222222'
            ,'car_num' => '湘D8888'  
            ,'file_num' =>'4224110000'
            ,'sex' => '女'
            ,'index' => '435405000029019'
        ];
        
        self::$id = Record::add($data, self::$owner);
        $this->assertNotFalse(self::$id);        
        
    }
    
    
    
    /***
     * @depends testAdd_default_returnId
     */
    public function test_getById_returnArray(){
        $result = Record::getById(self::$id, self::$owner);
        $this->assertEquals(self::$id, $result['id']);
    }
    
    
    /***
     * @depends testAdd_default_returnId
     */
    public function test_refresh_default_returnInt(){
        $data = ['name' => '陶怡瑾更新'
            ,'identity' => '4304441989133333'
            ,'car_num' => '湘D8885'  //car
            ,'file_num' =>'4224113333'
            ,'sex' => '女'
            ,'index' => '435405000029014'
        ];
        
        
        $id = Record::refresh(self::$id, $data, self::$owner);
        $this->assertNotFalse($id);
    }
    
    /***
     * @depends testAdd_default_returnId
     */
    public function test_remove_default_returnInt(){
       $effectCount = Record::remove(self::$id, self::$owner);
       $this->assertEquals(1, $effectCount);
    }
    
    
    
    
    
}

