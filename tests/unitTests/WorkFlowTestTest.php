<?php

/**
 * WorkFlowTest test case.
 */
class WorkFlowTestTest extends PHPUnit_Framework_TestCase
{


    private $workFlowTest;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        

    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {

    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        
    }
    
    public function testAddRecord_default_returnSuccess(){
        $data = ['name' => '陶怡瑾22'
            ,'identity' => '430444198912222222'
            ,'car_num' => '湘D8888'  //car
            ,'file_num' =>'4224110000'
            ,'name' => '陶一斤'
            ,'sex' => '女'
            ,'index' => '435405000029019'
            ,'zhidui' => '衡阳支队'
            ,'dadui' => '蒸湘大队'
            ,'police_1' => '贺静'
            ,'police_2' => '卢引出'
            ,'time' => '2018年11月08日00时00分'
            ,'judge_time' => '2018年11月09日00时00分'
            ,'code_1' => '11110'
            ,'place' => '岳林高速311公里'
        ];
    }
}

