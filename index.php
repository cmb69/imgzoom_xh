<?php

/**
 * Main ;)
 *
 * PHP version 5
 *
 * @category  CMSimple_XH
 * @package   Imgzoom
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2014-2016 Christoph M. Becker <http://3-magi.net>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link      http://3-magi.net/?CMSimple_XH/Imgzoom_XH
 */

/**
 * The plugin version.
 */
define('IMGZOOM_VERSION', '@IMGZOOM_VERSION@');

/**
 * The plugin controller.
 */
$_Imgzoom_controller = new Imgzoom_Controller();
$_Imgzoom_controller->dispatch();

?>
