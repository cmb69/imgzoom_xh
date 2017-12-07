<?php

/**
 * Testing the general plugin administration.
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

namespace Imgzoom;

use PHPUnit\Framework\TestCase;
use PHPUnit_Extensions_MockFunction;

require_once './vendor/autoload.php';
require_once '../../cmsimple/adminfuncs.php';

/**
 * Testing the general plugin administration.
 *
 * @category Testing
 * @package  Imgzoom
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Imgzoom_XH
 */
class AdministrationTest extends TestCase
{
    /**
     * Sets up the test fixture.
     *
     * @return void
     */
    public function setUp()
    {
        new PHPUnit_Extensions_MockFunction('XH_registerStandardPluginMenuItems', null);
    }

    /**
     * Tests the stylesheet administration.
     *
     * @return void
     *
     * @global string Whether the plugin administration is requested.
     * @global string The value of the <var>admin</var> GP parameter.
     * @global string The value of the <var>action</var> GP parameter.
     */
    public function testStylesheet()
    {
        global $imgzoom, $admin, $action;

        $this->defineConstant('XH_ADM', true);
        $imgzoom = 'true';
        $admin = 'plugin_stylesheet';
        $action = 'plugin_text';
        $subject = new Controller();
        $printPluginAdmin = new PHPUnit_Extensions_MockFunction('print_plugin_admin', $subject);
        $printPluginAdmin->expects($this->once())->with('off');
        $pluginAdminCommon = new PHPUnit_Extensions_MockFunction('plugin_admin_common', $subject);
        $pluginAdminCommon->expects($this->once())
            ->with($action, $admin, 'imgzoom');
        $subject->dispatch();
    }

    /**
     * (Re)defines a constant.
     *
     * @param string $name  A name.
     * @param string $value A value.
     *
     * @return void
     */
    private function defineConstant($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        } else {
            runkit_constant_redefine($name, $value);
        }
    }
}
