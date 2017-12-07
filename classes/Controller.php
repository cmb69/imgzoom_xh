<?php

/**
 * The controllers.
 *
 * PHP version 5
 *
 * @category  CMSimple_XH
 * @package   Imgzoom
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2014-2017 Christoph M. Becker <http://3-magi.net>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link      http://3-magi.net/?CMSimple_XH/Imgzoom_XH
 */

namespace Imgzoom;

/**
 * The controllers.
 *
 * @category CMSimple_XH
 * @package  Imgzoom
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Imgzoom_XH
 */
class Controller
{
    /**
     * The image folder.
     *
     * @var string
     */
    private $imageFolder;

    /**
     * Initializes a new instance.
     *
     * @return void
     *
     * @global array The paths of system files and folders.
     */
    public function __construct()
    {
        global $pth;

        $this->imageFolder = $pth['folder']['images'];
    }

    /**
     * Dispatch according to the request.
     *
     * @return void
     */
    public function dispatch()
    {
        if (isset($_GET['imgzoom_image'])) {
            $this->renderViewer();
        } elseif (defined('XH_ADM') && XH_ADM) {
            XH_registerStandardPluginMenuItems(false);
            if ($this->isAdministrationRequested()) {
                $this->handleAdministration();
            }
        }
    }

    /**
     * Renders an image viewer.
     *
     * @return void
     */
    protected function renderViewer()
    {
        $image = stsl($_GET['imgzoom_image']);
        $image = preg_replace('/\.\.\//', '', $image);
        echo $this->render($image);
        XH_exit();
    }

    /**
     * Returns whether the plugin administration is requested.
     *
     * @return bool
     *
     * @global Whether the plugin administration is requested.
     */
    protected function isAdministrationRequested()
    {
        global $imgzoom;

        return function_exists('XH_wantsPluginAdministration')
            && XH_wantsPluginAdministration('imgzoom')
            || isset($imgzoom) && $imgzoom == 'true';
    }

    /**
     * Renders the page.
     *
     * @param string $image An image filename.
     *
     * @return string (X)HTML
     *
     * @global array The paths of system files and folders.
     */
    private function render($image)
    {
        global $pth;

        $src = $this->imageFolder . $image;
        $css = $pth['folder']['plugins'] . 'imgzoom/css/stylesheet.css';
        $js = $pth['folder']['plugins'] . 'imgzoom/imgzoom.js';
        header('Content-Type:text/html; charset=UTF-8');
        return <<<EOT
<!DOCTYPE html>
<html class="imgzoom_view">
    <head>
        <title>$image</title>
        <link rel="stylesheet" type="text/css" href="$css">
    </head>
    <body>
        <img src="$src" alt="$image">
        <script type="text/javascript" src="$js"></script>
    </body>
</html>
EOT;
    }

    /**
     * Handles the plugin administration.
     *
     * @return void
     *
     * @global string The value of the <var>admin</var> parameter.
     * @global string The value of the <var>action</var> parameter.
     * @global string The (X)HTML of the contents area.
     */
    private function handleAdministration()
    {
        global $admin, $action, $o;

        $o .= print_plugin_admin('off');
        switch ($admin) {
            case '':
                $o .= $this->renderInfo();
                break;
            default:
                $o .= plugin_admin_common($action, $admin, 'imgzoom');
        }
    }

    /**
     * Renders the plugin info.
     *
     * @return string (X)HTML.
     */
    private function renderInfo()
    {
        return '<h1>Imgzoom</h1>'
            . $this->renderIcon() . $this->renderVersion()
            . $this->renderCopyright() . $this->renderLicense();
    }

    /**
     * Renders the plugin icon.
     *
     * @return string (X)HTML.
     *
     * @global array The paths of system files and folders.
     * @global array The localization of the plugins.
     */
    private function renderIcon()
    {
        global $pth, $plugin_tx;

        return tag(
            'img class="imgzoom_icon" src="' . $pth['folder']['plugins']
            . 'imgzoom/imgzoom.png" alt="' . $plugin_tx['imgzoom']['alt_icon']
            . '"'
        );
    }

    /**
     * Renders the plugin version.
     *
     * @return string (X)HTML.
     */
    private function renderVersion()
    {
        return '<p>Version: ' . IMGZOOM_VERSION . '</p>';
    }

    /**
     * Renders the copyright info.
     *
     * @return (X)HTML.
     */
    private function renderCopyright()
    {
        return <<<EOT
<p>Copyright &copy; 2014-2017
    <a href="http://3-magi.net/" target="_blank">Christoph M. Becker</a>
</p>
EOT;
    }

    /**
     * Renders the license info.
     *
     * @return (X)HTML.
     */
    private function renderLicense()
    {
        return <<<EOT
<p class="imgzoom_license">This program is free software: you can
redistribute it and/or modify it under the terms of the GNU General Public
License as published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.</p>
<p class="imgzoom_license">This program is distributed in the hope that it
will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHAN&shy;TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General
Public License for more details.</p>
<p class="imgzoom_license">You should have received a copy of the GNU
General Public License along with this program. If not, see <a
href="http://www.gnu.org/licenses/" target="_blank">http://www.gnu.org/licenses/</a>.
</p>
EOT;
    }
}
