<?php

/*
 * Copyright (c) Christoph M. Becker
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

use Plib\Request;
use Plib\Response;
use Plib\SystemChecker;
use Plib\View;

class InfoController
{
    /** @var string */
    private $pluginFolder;

    /** @var SystemChecker */
    private $systemChecker;

    /** @var View */
    private $view;

    public function __construct(string $pluginFolder, SystemChecker $systemChecker, View $view)
    {
        $this->pluginFolder = $pluginFolder;
        $this->systemChecker = $systemChecker;
        $this->view = $view;
    }

    public function __invoke(Request $request): Response
    {
        return Response::create($this->view->render('info', [
            'logo' => $this->pluginFolder . "imgzoom.png",
            'version' => IMGZOOM_VERSION,
            'checks' => [
                $this->checkPhpVersion('7.1.0'),
                $this->checkXhVersion('1.7.0'),
                $this->checkPlib(),
                $this->checkWritability($this->pluginFolder . "css/"),
                $this->checkWritability($this->pluginFolder . "languages/"),
            ],
        ]));
    }

    /** @return array{class:string,label:string,stateLabel:string} */
    private function checkPhpVersion(string $version): array
    {
        $state = $this->systemChecker->checkVersion(PHP_VERSION, $version) ? 'success' : 'fail';
        return [
            'class' => "xh_$state",
            'label' => $this->view->plain('syscheck_phpversion', $version),
            'stateLabel' => $this->view->plain("syscheck_$state"),
        ];
    }

    /** @return array{class:string,label:string,stateLabel:string} */
    private function checkXhVersion(string $version): array
    {
        $state = $this->systemChecker->checkVersion(CMSIMPLE_XH_VERSION, "CMSimple_XH $version") ? 'success' : 'fail';
        return [
            'class' => "xh_$state",
            'label' => $this->view->plain('syscheck_xhversion', $version),
            'stateLabel' => $this->view->plain("syscheck_$state"),
        ];
    }

    /** @return array{class:string,label:string,stateLabel:string} */
    private function checkPlib()
    {
        $state = $this->systemChecker->checkPlugin("plib") ? 'success' : 'fail';
        return [
            'class' => "xh_$state",
            'label' => $this->view->plain('syscheck_plugin', 'Plib_XH'),
            'stateLabel' => $this->view->plain("syscheck_$state"),
        ];
    }

    /** @return array{class:string,label:string,stateLabel:string} */
    private function checkWritability(string $folder): array
    {
        $state = $this->systemChecker->checkWritability($folder) ? 'success' : 'warning';
        return [
            'class' => "xh_$state",
            'label' => $this->view->plain('syscheck_writable', $folder),
            'stateLabel' => $this->view->plain("syscheck_$state"),
        ];
    }
}
