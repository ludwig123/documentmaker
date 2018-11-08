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
        
        // TODO Auto-generated CodeTest::setUp()
        
        $this->code = new Code(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated CodeTest::tearDown()
        $this->code = null;
        
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
}

