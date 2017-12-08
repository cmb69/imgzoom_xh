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

class InfoController
{
    /**
     * @return void
     */
    public function defaultAction()
    {
        global $pth;

        (new View('imgzoom'))
            ->template('info')
            ->data([
                'logo' => "{$pth['folder']['plugins']}imgzoom/imgzoom.png",
                'version' => IMGZOOM_VERSION
            ])
            ->render();
    }
}
