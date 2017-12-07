<?php

/**
 * Testing the zoom view.
 *
 * PHP version 5
 *
 * @category  Testing
 * @package   Imgzoom
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2014-2017 Christoph M. Becker <http://3-magi.net>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link      http://3-magi.net/?CMSimple_XH/Imgzoom_XH
 */

namespace Imgzoom;

use PHPUnit\Framework\TestCase;
use PHPUnit_Extensions_MockFunction;

require_once './vendor/autoload.php';
require_once '../../cmsimple/functions.php';

/**
 * Testing the feed view.
 *
 * @category Testing
 * @package  Imgzoom
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Imgzoom_XH
 */
class ZoomViewTest extends TestCase
{
    /**
     * The test subject.
     *
     * @var Controller
     */
    private $subject;

    /**
     * The exit mock function.
     *
     * @var object
     */
    private $exit;

    /**
     * The header mock function.
     *
     * @var object
     */
    private $header;

    /**
     * Sets up the test fixture.
     *
     * @return void
     *
     * @global array The paths of system files and folders.
     */
    public function setUp()
    {
        global $pth;

        $_GET['imgzoom_image'] = 'foo';
        $pth['folder'] = array(
            'images' => 'bar/',
            'plugins' => ''
        );
        $this->subject = new Controller();
        $this->exit = new PHPUnit_Extensions_MockFunction('XH_exit', $this->subject);
        $this->header = new PHPUnit_Extensions_MockFunction('header', $this->subject);
    }

    /**
     * Tests that the appropriate Content-Type header is sent.
     *
     * @return void
     */
    public function testSendsContentTypeHeader()
    {
        $this->header->expects($this->once())
            ->with('Content-Type:text/html; charset=UTF-8');
        $this->dispatchResult();
    }

    /**
     * Tests that the view exists CMSimple_XH early.
     *
     * @return void
     */
    public function testExitsEarly()
    {
        $this->exit->expects($this->once());
        $this->dispatchResult();
    }

    /**
     * Calls dispatch and returns its output.
     *
     * @return string (X)HTML
     */
    private function dispatchResult()
    {
        ob_start();
        $this->subject->dispatch();
        return ob_get_clean();
    }
}
