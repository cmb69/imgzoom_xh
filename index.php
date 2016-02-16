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

/*
 * Prevent direct access and usage from unsupported CMSimple_XH versions.
 */
if (!defined('CMSIMPLE_XH_VERSION')
    || strpos(CMSIMPLE_XH_VERSION, 'CMSimple_XH') !== 0
    || version_compare(CMSIMPLE_XH_VERSION, 'CMSimple_XH 1.5.4', 'lt')
) {
    header('HTTP/1.1 403 Forbidden');
    header('Content-Type: text/plain; charset=UTF-8');
    die(
        <<<EOT
Imgzoom_XH detected an unsupported CMSimple_XH version.
Deinstall Imgzoom_XH or upgrade to a supported CMSimple_XH version!
EOT
    );
}

/**
 * The presentation layer.
 */
require_once $pth['folder']['plugin_classes'] . 'Presentation.php';

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
