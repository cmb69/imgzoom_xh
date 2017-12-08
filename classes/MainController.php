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

class MainController
{
    /**
     * @return void
     */
    public function defaultAction()
    {
        $image = $_GET['imgzoom_image'];
        $image = preg_replace('/\.\.\//', '', $image);
        header('Content-Type:text/html; charset=UTF-8');
        $this->prepareView($image)->render();
        XH_exit();
    }

    /**
     * @param string $image
     * @return View
     */
    private function prepareView($image)
    {
        global $pth;

        $src = $pth['folder']['images'] . $image;
        $css = $pth['folder']['plugins'] . 'imgzoom/css/stylesheet.css';
        $js = $pth['folder']['plugins'] . 'imgzoom/imgzoom.min.js';
        if (!file_exists($js)) {
            $js = "{$pth['folder']['plugins']}imgzoom/imgzoom.js";
        }
        return View::create('imgzoom')
            ->template('viewer')
            ->data(compact('image', 'src', 'css', 'js'));
    }
}
