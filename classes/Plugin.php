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

class Plugin
{
    const VERSION = '1.0beta3';

    /**
     * @return void
     */
    public function run()
    {
        global $pth, $plugin_tx;

        if (isset($_GET['imgzoom_image'])) {
            Dic::mainController()->defaultAction();
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
    private function handleAdministration()
    {
        global $admin, $o;

        $o .= print_plugin_admin('off');
        switch ($admin) {
            case '':
                ob_start();
                Dic::infoController()->defaultAction();
                $o .= ob_get_clean();
                break;
            default:
                $o .= plugin_admin_common();
        }
    }
}
