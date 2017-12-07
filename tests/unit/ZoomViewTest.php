<?php

/**
 * Testing the zoom view.
 *
 * PHP version 5
 *
 * @category  Testing
 * @package   Imgzoom
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2014-2016 Christoph M. Becker <http://3-magi.net>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link      http://3-magi.net/?CMSimple_XH/Imgzoom_XH
 */

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
class ZoomViewTest extends PHPUnit_Framework_TestCase
{
    /**
     * The test subject.
     *
     * @var Imgzoom_Controller
     */
    private $_subject;

    /**
     * The exit mock function.
     *
     * @var object
     */
    private $_exit;

    /**
     * The header mock function.
     *
     * @var object
     */
    private $_header;

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
        $this->_subject = new Imgzoom\Controller();
        $this->_exit = new PHPUnit_Extensions_MockFunction(
            'XH_exit', $this->_subject
        );
        $this->_header = new PHPUnit_Extensions_MockFunction(
            'header', $this->_subject
        );
    }

    /**
     * Tests that the appropriate Content-Type header is sent.
     *
     * @return void
     */
    public function testSendsContentTypeHeader()
    {
        $this->_header->expects($this->once())
            ->with('Content-Type:text/html; charset=UTF-8');
        $this->_dispatchResult();
    }

    /**
     * Tests that the view exists CMSimple_XH early.
     *
     * @return void
     */
    public function testExitsEarly()
    {
        $this->_exit->expects($this->once());
        $this->_dispatchResult();
    }

    /**
     * Calls dispatch and returns its output.
     *
     * @return string (X)HTML
     */
    private function _dispatchResult()
    {
        ob_start();
        $this->_subject->dispatch();
        return ob_get_clean();
    }
}

?>
