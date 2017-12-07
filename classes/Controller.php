<?php

/*
 * Copyright 2014-2017 Christoph M. Becker
 *
 * This file is part of Imgzoom_XH.
 *
 * Imgzoom_XH is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Imgzoom_XH is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Imgzoom_XH.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Imgzoom;

class Controller
{
    /**
     * @var string
     */
    private $imageFolder;

    /**
     * @return void
     */
    public function __construct()
    {
        global $pth;

        $this->imageFolder = $pth['folder']['images'];
    }

    /**
     * @return void
     */
    public function dispatch()
    {
        if (isset($_GET['imgzoom_image'])) {
            $this->renderViewer();
        } elseif (defined('XH_ADM') && XH_ADM) {
            XH_registerStandardPluginMenuItems(false);
            if (XH_wantsPluginAdministration('imgzoom')) {
                $this->handleAdministration();
            }
        }
    }

    /**
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
     * @param string $image
     * @return string
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
     * @return void
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
     * @return string
     */
    private function renderInfo()
    {
        return '<h1>Imgzoom</h1>'
            . $this->renderIcon() . $this->renderVersion()
            . $this->renderCopyright() . $this->renderLicense();
    }

    /**
     * @return string
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
     * @return string
     */
    private function renderVersion()
    {
        return '<p>Version: ' . IMGZOOM_VERSION . '</p>';
    }

    /**
     * @return
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
     * @return
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
