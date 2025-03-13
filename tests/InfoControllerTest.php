<?php

namespace Imgzoom;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;
use Plib\FakeRequest;
use Plib\FakeSystemChecker;
use Plib\View;

class InfoControllerTest extends TestCase
{
    public function testShowsPluginInfo(): void
    {
        $sut = new InfoController(
            "./",
            new FakeSystemChecker(),
            new View("./views/", XH_includeVar("./languages/en.php", "plugin_tx")["imgzoom"])
        );
        Approvals::verifyHtml($sut->defaultAction(new FakeRequest())->output());
    }
}
