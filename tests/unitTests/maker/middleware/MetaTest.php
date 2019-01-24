<?php
use PHPUnit\Framework\TestCase;
use app\maker\middleware\Meta;

require_once 'application/maker/middleware/Meta.php';

/**
 * Meta test case.
 */
class MetaTest extends TestCase
{

    /**
     *
     * @var Meta
     */
    private $meta, $name, $value;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        $this->name = '当事人';
        $this->value = '李大嘴';
        $this->meta = new Meta($this->name, $this->value);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->meta = null;
        
        parent::tearDown();
    }


    /**
     * Tests Meta->__construct()
     */
    public function test__construct_identify_mustbe_md5_had16chars()
    {
        $this->assertEquals(32, strlen($this->meta->identify()));
        $this->assertEquals($this->name, $this->meta->name());
        $this->assertEquals($this->value, $this->meta->value());
    }
   
    
}

