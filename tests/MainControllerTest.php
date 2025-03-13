<?php

namespace Imgzoom;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;
use Plib\FakeRequest;
use Plib\View;

class MainControllerTest extends TestCase
{
    public function testShowsImageViewer(): void
    {
        $sut = new MainController(
            "./",
            "../../userfiles/images/",
            $this->view()
        );
        $request = new FakeRequest(["url" => "http://example.com/?&imgzoom_image=foo.jpg"]);
        $response = $sut($request);
        $this->assertSame("text/html; charset=UTF-8", $response->contentType());
        Approvals::verifyHtml($response->output());
    }

    public function testIgnoresUnrelatedRequests(): void
    {
        $sut = new MainController(
            "./",
            "../../userfiles/images/",
            $this->view()
        );
        $this->assertSame("", $sut(new FakeRequest())->output());
    }

    private function view(): View
    {
        return new View("./views/", XH_includeVar("./languages/en.php", "plugin_tx")["imgzoom"]);
    }
}