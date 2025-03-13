<?php

namespace Imgzoom;

use PHPUnit\Framework\TestCase;

class DicTest extends TestCase
{

    public function setUp(): void
    {
        global $pth, $plugin_tx;

        $pth = ["folder" => ["plugins" => ""]];
        $plugin_tx = ["imgzoom" => []];
    }

    public function testMakeMainController(): void
    {
        $this->assertInstanceOf(MainController::class, Dic::mainController());
    }

    public function testMakesInfoController(): void
    {
        $this->assertInstanceOf(InfoController::class, Dic::infoController());
    }
}
