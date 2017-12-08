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

use PHPUnit\Framework\TestCase;
use PHPUnit_Extensions_MockFunction;

class AdministrationTest extends TestCase
{
    /**
     * @return void
     */
    public function setUp()
    {
        new PHPUnit_Extensions_MockFunction('XH_registerStandardPluginMenuItems', null);
    }

    /**
     * @return void
     */
    public function testStylesheet()
    {
        global $admin, $action;

        $this->defineConstant('XH_ADM', true);
        $admin = 'plugin_stylesheet';
        $action = 'plugin_text';
        $subject = new Controller();
        $printPluginAdmin = new PHPUnit_Extensions_MockFunction('print_plugin_admin', $subject);
        $printPluginAdmin->expects($this->once())->with('off');
        $pluginAdminCommon = new PHPUnit_Extensions_MockFunction('plugin_admin_common', $subject);
        $pluginAdminCommon->expects($this->once())
            ->with($action, $admin, 'imgzoom');
        $wpamock = new PHPUnit_Extensions_MockFunction('XH_wantsPluginAdministration', $subject);
        $wpamock->expects($this->any())->willReturn(true);
        $subject->dispatch();
    }

    /**
     * @param string $name
     * @param string $value
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
