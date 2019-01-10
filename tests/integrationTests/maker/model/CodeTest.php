<?php
use app\maker\model\Code;

require_once 'application/maker/model/Code.php';

/**
 * Code test case.
 */
class CodeTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Code
     */
    private $code;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        
        $this->code = new Code(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->code = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
    }

    /**
     * Tests Code::getDetail()
     */
    public function testGetDetail_CodeNotExist_ReturnNull()
    {
        
        $result = Code::getDetail('11111');
        $this->assertNull($result);
    }
    
    public function testGetDetail_CodeExist_ReturnArray()
    {
        
        $result = Code::getDetail('11110');
        $this->assertEquals('11110', $result['违法代码']);
    }
    
    public function testGetFullLaw_ByDefault_ReturnString()
    {
        $short = '《法》第100条第1款、第2款、《法》第95条第1款、第110条第1款、《办法》第53条第9项';
        $expect = '《中华人民共和国道路交通安全法》第100条第1款、第2款、《中华人民共和国道路交通安全法》第95条第1款、第110条第1款、《湖南省实施〈中华人民共和国道路交通安全法〉办法》第53条第9项';
        $full = Code::getFullLaw($short);
        $this->assertEquals($expect, $full);
    }
}

