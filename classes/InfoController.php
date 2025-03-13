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

use Plib\SystemChecker;
use Plib\View;

class InfoController
{
    /** @var SystemChecker */
    private $systemChecker;

    /** @var View */
    private $view;

    public function __construct()
    {
        global $pth, $plugin_tx;

        $this->systemChecker = new SystemChecker();
        $this->view = new View("{$pth["folder"]["plugins"]}imgzoom/views/", $plugin_tx["imgzoom"]);
    }

    /**
     * @return void
     */
    public function defaultAction()
    {
        global $pth;

        echo $this->view->render('info', [
            'logo' => "{$pth['folder']['plugins']}imgzoom/imgzoom.png",
            'version' => Plugin::VERSION,
            'checks' => [
                $this->checkPhpVersion('5.4.0'),
                $this->checkXhVersion('1.6.3'),
                $this->checkPlib(),
                $this->checkWritability("{$pth['folder']['plugins']}imgzoom/css/"),
                $this->checkWritability("{$pth['folder']['plugins']}imgzoom/languages/"),
            ],
        ]);
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
