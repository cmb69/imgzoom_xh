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

use Plib\View;

class MainController
{
    /** @var string */
    private $pluginFolder;

    /** @var string */
    private $imageFolder;

    /** @var View */
    private $view;

    public function __construct(string $pluginFolder, string $imageFolder, View $view)
    {
        $this->pluginFolder = $pluginFolder;
        $this->imageFolder = $imageFolder;
        $this->view = $view;
    }

    /**
     * @return void
     */
    public function defaultAction()
    {
        $image = $_GET['imgzoom_image'];
        $image = preg_replace('/\.\.\//', '', $image);
        header('Content-Type:text/html; charset=UTF-8');
        echo $this->prepareView($image);
        XH_exit();
    }

    /**
     * @param string $image
     * @return string
     */
    private function prepareView($image)
    {
        $src = $this->imageFolder . $image;
        $css = "{$this->pluginFolder}css/stylesheet.css";
        $js = "{$this->pluginFolder}imgzoom.min.js";
        if (!file_exists($js)) {
            $js = "{$this->pluginFolder}imgzoom.js";
        }
        return $this->view->render('viewer', compact('image', 'src', 'css', 'js'));
    }
}
