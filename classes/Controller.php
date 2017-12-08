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

use Pfw\View\View;

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
        $image = $_GET['imgzoom_image'];
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
        ob_start();
        View::create('imgzoom')
            ->template('viewer')
            ->data(compact('image', 'src', 'css', 'js'))
            ->render();
        return ob_get_clean();
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
                ob_start();
                (new InfoController)->defaultAction();
                $o .= ob_get_clean();
                break;
            default:
                $o .= plugin_admin_common($action, $admin, 'imgzoom');
        }
    }
}
