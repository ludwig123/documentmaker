<?php

use app\maker\model\TempletDoc;

require_once 'application/maker/controller/Templet.php';

/**
 * Templet test case.
 */
class TempletDocTest extends PHPUnit_Framework_TestCase
{
    
    protected static $id;



    public function testAdd_addDefaultTemplet_returnId()
    {
        $data = ['templet_catalog' => '陶怡瑾22'
            ,'templet_name' => '430444198912222222'
            ,'templet_content' => '<p class="MsoNormal" style="text-indent:118.75pt;line-height:27.45pt;mso-pagination:
none;layout-grid-mode:char"><span lang="EN-US"><div>&nbsp;<br></div></span></p><p class="MsoNormal" align="center" style="text-align:center;line-height:27.45pt;
mso-pagination:none;layout-grid-mode:char"><span class="size" style="font-size:24pt"><div>&nbsp;<br></div></span></p><p class="MsoNormal" align="center" style="text-align:center;line-height:27.45pt;
mso-pagination:none;layout-grid-mode:char"><div><b style="mso-bidi-font-weight:normal"><span class="font" style="font-family:宋体"><span class="size" style="font-size:24pt">查</span></span></b><b style="mso-bidi-font-weight:normal"><span class="size" style="font-size:24pt"><span style="mso-spacerun:yes">&nbsp; </span></span></b><b style="mso-bidi-font-weight:normal"><span class="font" style="font-family:宋体"><span class="size" style="font-size:24pt">获</span></span></b><b style="mso-bidi-font-weight:normal"><span class="size" style="font-size:24pt"><span style="mso-spacerun:yes">&nbsp; </span></span></b><b style="mso-bidi-font-weight:
normal"><span class="font" style="font-family:宋体"><span class="size" style="font-size:24pt">经</span></span></b><b style="mso-bidi-font-weight:normal"><span class="size" style="font-size:24pt"><span style="mso-spacerun:yes">&nbsp; </span></span></b><b style="mso-bidi-font-weight:normal"><span class="font" style="font-family:宋体"><span class="size" style="font-size:24pt">过</span></span></b><br></div><span lang="EN-US"></span></p><p class="MsoNormal" style="text-indent:118.75pt;line-height:27.45pt;mso-pagination:
none;layout-grid-mode:char"><span lang="EN-US"><div>&nbsp;<br></div></span></p><p class="MsoNormal" style="text-indent:35.1pt;line-height:26.35pt;mso-pagination:
none;layout-grid-mode:char"><div><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt">2017</span></span><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt">年<span lang="EN-US">04</span>月<span lang="EN-US">07</span>日</span></span><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt">11</span></span><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt">时<span lang="EN-US">15</span>分</span></span><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt">，</span></span><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt">湖南省衡南县</span></span><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt">冠市镇西头村上里组的</span></span><span style="text-indent: 35.1pt; font-size: 18.6667px;"><font face="仿宋_GB2312">{姓名}</font></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">驾驶</span></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">湘<span lang="EN-US">D22C08</span>轻型仓栅式货车</span></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">行至</span></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">泉南高速公路<span lang="EN-US">801</span>公里珠晖南收费站出口时</span></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">,</span></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">因实施</span></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">未取得机动车驾驶证驾驶摩托车、拖拉机、营运载客汽车以外的机动车</span></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">的违法行为，被我们当场查获。我们依法开具</span></span><span style="text-indent: 35.1pt; font-size: 18.6667px;"><font face="仿宋_GB2312">{性别}</font></span><span style="font-size: 14pt; font-family: 仿宋_GB2312; text-indent: 35.1pt;">号《道路交通安全违法行为处理通知书》交付当事人，并通知当事人携带此凭证和相关合法手续</span><span lang="EN-US" style="font-size: 14pt; font-family: 仿宋_GB2312; text-indent: 35.1pt;">15</span><span style="font-size: 14pt; font-family: 仿宋_GB2312; text-indent: 35.1pt;">日内到湖南省高速公路交通警察局衡阳支队衡阳西大队接受处理。</span></div><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt"></span></span></p><p class="MsoNormal" style="text-align:justify;text-justify:distribute-all-lines;
line-height:26.35pt;mso-pagination:none;layout-grid-mode:char"><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt"><div class=" align-center" style="text-align: center;">&nbsp;<span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt"><span style="mso-spacerun:yes">&nbsp;</span>执勤民警：<u><span lang="EN-US"><span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></u></span></span>、<u><span lang="EN-US"><span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></u><br></div><div class=" align-center" style="text-align: center;"><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt"><span style="mso-spacerun:yes">&nbsp; </span></span></span><u style="text-underline:
#000000"><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt"><span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></u>年<u><span lang="EN-US"><span style="mso-spacerun:yes">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</span></span></u>月<u><span lang="EN-US"><span style="mso-spacerun:yes">&nbsp; &nbsp;&nbsp;&nbsp;</span></span></u>日<span style="mso-spacerun:yes">&nbsp; &nbsp; &nbsp; &nbsp;</span><br></div></span></span></p><p class="MsoNormal" align="right" style="text-align:right;line-height:26.35pt;
mso-pagination:none;layout-grid-mode:char;word-break:break-all"><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt"><span lang="EN-US"></span></span></span></p><div><br></div>'
            ,'templet_owner' => 0
        ];
        
        self::$id = TempletDoc::add($data);
        $this->assertNotFalse(self::$id);
    }
    
    
    /**
     *@depends testAdd_addDefaultTemplet_returnId
     **/
    public function testGetDefaultTemplet(){
        $result = TempletDoc::getById(self::$id);
        $this->assertEquals(self::$id, $result['id']);
    }
    
    /**
     *@depends testAdd_addDefaultTemplet_returnId
     **/
    public function testRefresh_default_returnId()
    {
        $data = ['templet_catalog' => '陶怡瑾33'
            ,'templet_name' => '430444198912222222'
            ,'templet_content' => '<p class="MsoNormal" style="text-indent:118.75pt;line-height:27.45pt;mso-pagination:
none;layout-grid-mode:char"><span lang="EN-US"><div>&nbsp;<br></div></span></p><p class="MsoNormal" align="center" style="text-align:center;line-height:27.45pt;
mso-pagination:none;layout-grid-mode:char"><span class="size" style="font-size:24pt"><div>&nbsp;<br></div></span></p><p class="MsoNormal" align="center" style="text-align:center;line-height:27.45pt;
mso-pagination:none;layout-grid-mode:char"><div><b style="mso-bidi-font-weight:normal"><span class="font" style="font-family:宋体"><span class="size" style="font-size:24pt">查</span></span></b><b style="mso-bidi-font-weight:normal"><span class="size" style="font-size:24pt"><span style="mso-spacerun:yes">&nbsp; </span></span></b><b style="mso-bidi-font-weight:normal"><span class="font" style="font-family:宋体"><span class="size" style="font-size:24pt">获</span></span></b><b style="mso-bidi-font-weight:normal"><span class="size" style="font-size:24pt"><span style="mso-spacerun:yes">&nbsp; </span></span></b><b style="mso-bidi-font-weight:
normal"><span class="font" style="font-family:宋体"><span class="size" style="font-size:24pt">经</span></span></b><b style="mso-bidi-font-weight:normal"><span class="size" style="font-size:24pt"><span style="mso-spacerun:yes">&nbsp; </span></span></b><b style="mso-bidi-font-weight:normal"><span class="font" style="font-family:宋体"><span class="size" style="font-size:24pt">过</span></span></b><br></div><span lang="EN-US"></span></p><p class="MsoNormal" style="text-indent:118.75pt;line-height:27.45pt;mso-pagination:
none;layout-grid-mode:char"><span lang="EN-US"><div>&nbsp;<br></div></span></p><p class="MsoNormal" style="text-indent:35.1pt;line-height:26.35pt;mso-pagination:
none;layout-grid-mode:char"><div><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt">2017</span></span><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt">年<span lang="EN-US">04</span>月<span lang="EN-US">07</span>日</span></span><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt">11</span></span><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt">时<span lang="EN-US">15</span>分</span></span><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt">，</span></span><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt">湖南省衡南县</span></span><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt">冠市镇西头村上里组的</span></span><span style="text-indent: 35.1pt; font-size: 18.6667px;"><font face="仿宋_GB2312">{姓名}</font></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">驾驶</span></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">湘<span lang="EN-US">D22C08</span>轻型仓栅式货车</span></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">行至</span></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">泉南高速公路<span lang="EN-US">801</span>公里珠晖南收费站出口时</span></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">,</span></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">因实施</span></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">未取得机动车驾驶证驾驶摩托车、拖拉机、营运载客汽车以外的机动车</span></span><span class="font" style="text-indent: 35.1pt; font-family: 仿宋_GB2312;"><span class="size" style="font-size:14pt">的违法行为，被我们当场查获。我们依法开具</span></span><span style="text-indent: 35.1pt; font-size: 18.6667px;"><font face="仿宋_GB2312">{性别}</font></span><span style="font-size: 14pt; font-family: 仿宋_GB2312; text-indent: 35.1pt;">号《道路交通安全违法行为处理通知书》交付当事人，并通知当事人携带此凭证和相关合法手续</span><span lang="EN-US" style="font-size: 14pt; font-family: 仿宋_GB2312; text-indent: 35.1pt;">15</span><span style="font-size: 14pt; font-family: 仿宋_GB2312; text-indent: 35.1pt;">日内到湖南省高速公路交通警察局衡阳支队衡阳西大队接受处理。</span></div><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt"></span></span></p><p class="MsoNormal" style="text-align:justify;text-justify:distribute-all-lines;
line-height:26.35pt;mso-pagination:none;layout-grid-mode:char"><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt"><div class=" align-center" style="text-align: center;">&nbsp;<span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt"><span style="mso-spacerun:yes">&nbsp;</span>执勤民警：<u><span lang="EN-US"><span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></u></span></span>、<u><span lang="EN-US"><span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></u><br></div><div class=" align-center" style="text-align: center;"><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt"><span style="mso-spacerun:yes">&nbsp; </span></span></span><u style="text-underline:
#000000"><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt"><span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></u>年<u><span lang="EN-US"><span style="mso-spacerun:yes">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</span></span></u>月<u><span lang="EN-US"><span style="mso-spacerun:yes">&nbsp; &nbsp;&nbsp;&nbsp;</span></span></u>日<span style="mso-spacerun:yes">&nbsp; &nbsp; &nbsp; &nbsp;</span><br></div></span></span></p><p class="MsoNormal" align="right" style="text-align:right;line-height:26.35pt;
mso-pagination:none;layout-grid-mode:char;word-break:break-all"><span class="font" style="font-family:仿宋_GB2312"><span class="size" style="font-size:14pt"><span lang="EN-US"></span></span></span></p><div><br></div>'
            ,'templet_owner' => 0
        ];
        
        $count = TempletDoc::refresh(self::$id, $data);
        $this->assertEquals(self::$id, $count);
    }
    
    /**
    *@depends testAdd_addDefaultTemplet_returnId
    **/
    public function testRemove_default_returnId()
    {
        $effectRow = TempletDoc::remove(self::$id);
        $this->assertEquals(1,$effectRow);
    }

    
    public function test_getCatalogArr_default_returnArray(){
        $catalogArr = TempletDoc::getCatalogArr();
        $this->assertGreaterThan(3, count($catalogArr));
    }

}

