<?php
use app\user\common\User;

require_once 'application/user/common/User.php';

/**
 * User test case.
 */
class UserTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var User
     */
    private $user , $id = '1';

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        $this->user = new User($this->id);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->user = null;
        
        parent::tearDown();
    }


    /**
     * Tests User->id()
     */
    public function testId()
    {
        $this->assertEquals($this->user->id(), $this->id);
    }

}

