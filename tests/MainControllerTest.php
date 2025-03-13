<?php

namespace Imgzoom;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;
use Plib\FakeRequest;
use Plib\View;

class MainControllerTest extends TestCase
{
    public function testShowsImageViewer()
    {
        $sut = new MainController(
            "./",
            "../../userfiles/images/",
            new View("./views/", XH_includeVar("./languages/en.php", "plugin_tx")["imgzoom"])
        );
        $request = new FakeRequest(["url" => "http://example.com/?&imgzoom_image=foo.jpg"]);
        $response = $sut->defaultAction($request);
        $this->assertSame("text/html; charset=UTF-8", $response->contentType());
        Approvals::verifyHtml($response->output());
    }
}