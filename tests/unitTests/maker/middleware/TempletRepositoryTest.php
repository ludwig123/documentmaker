<?php
use PHPUnit\Framework\TestCase;
use app\maker\middleware\TempletRepository;

require_once 'application/maker/middleware/TempletRepository.php';

/**
 * TempletRepository test case.
 */
class TempletRepositoryTest extends TestCase
{

    /**
     *
     * @var TempletRepository
     */
    private $templetRepository;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated TempletRepositoryTest::setUp()
        
        $this->templetRepository = new TempletRepository(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated TempletRepositoryTest::tearDown()
        $this->templetRepository = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        parent::__construct();
        // TODO Auto-generated constructor
    }

    /**
     * Tests TempletRepository->addMeta()
     */
    public function testAddMeta()
    {
        $suitId = '1';
        $data = array(
            'name' => 'tttt',
            'catalog' => 'rrrr',
            'type' => 'ffff'
        );
        
        $owner = '1';
        
        $this->templetRepository->addMeta($suitId, $data, $owner);
    }

    /**
     * Tests TempletRepository->removeMeta()
     */
    public function testRemoveMeta()
    {
        // TODO Auto-generated TempletRepositoryTest->testRemoveMeta()
        $this->markTestIncomplete("removeMeta test not implemented");
        
        $this->templetRepository->removeMeta(/* parameters */);
    }

    /**
     * Tests TempletRepository->refreshMeta()
     */
    public function testRefreshMeta()
    {
        // TODO Auto-generated TempletRepositoryTest->testRefreshMeta()
        $this->markTestIncomplete("refreshMeta test not implemented");
        
        $this->templetRepository->refreshMeta(/* parameters */);
    }

    /**
     * Tests TempletRepository->getMetas()
     */
    public function testGetMetas()
    {
        // TODO Auto-generated TempletRepositoryTest->testGetMetas()
        $this->markTestIncomplete("getMetas test not implemented");
        
        $this->templetRepository->getMetas(/* parameters */);
    }

    /**
     * Tests TempletRepository->getSuit()
     */
    public function testGetSuit()
    {
        // TODO Auto-generated TempletRepositoryTest->testGetSuit()
        $this->markTestIncomplete("getSuit test not implemented");
        
        $this->templetRepository->getSuit(/* parameters */);
    }

    /**
     * Tests TempletRepository->refreshSuit()
     */
    public function testRefreshSuit()
    {
        // TODO Auto-generated TempletRepositoryTest->testRefreshSuit()
        $this->markTestIncomplete("refreshSuit test not implemented");
        
        $this->templetRepository->refreshSuit(/* parameters */);
    }
}

