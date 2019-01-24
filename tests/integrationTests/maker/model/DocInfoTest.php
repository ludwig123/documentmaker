<?php

/**
 *  test case.
 */
use PHPUnit\Framework\TestCase;

class DocInfoTest extends TestCase
{
    protected static $id;
    
    public function __construct(){
        self::$id = '1';
    }
    public function test_add_default_returnId(){
        $docInfo = new DocInfo();
        $info = array(
            'metas' => 'hehehehe'
        );
        
       $docId = $docInfo->add($info, self::$id);
       $this->assertNotNull($docId);
    }
    
    public function test_remove_default_returnEffectRowCount(){
        
    }
}

