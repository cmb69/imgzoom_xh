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
use PHPUnit_Extensions_MockStaticMethod;
use Pfw\View\View;

class MainControllerTest extends TestCase
{
    /**
     * @var MainController
     */
    private $subject;

    /**
     * @var object
     */
    private $exit;

    /**
     * @var object
     */
    private $header;

    /**
     * @return void
     */
    public function setUp()
    {
        global $pth;

        $_GET['imgzoom_image'] = 'foo';
        $pth['folder'] = array(
            'images' => 'bar/',
            'plugins' => ''
        );
        $this->subject = new MainController();
        $this->exit = new PHPUnit_Extensions_MockFunction('XH_exit', $this->subject);
        $this->header = new PHPUnit_Extensions_MockFunction('header', $this->subject);
        $m = $this->createMock(View::class);
        $m->expects($this->any())->method($this->anything())->will($this->returnSelf());
        $mock = (new PHPUnit_Extensions_MockStaticMethod('Pfw\View\View::create', $this->subject));
        $mock->expects($this->any())->willReturn($m);
    }

    /**
     * @return void
     */
    public function testSendsContentTypeHeader()
    {
        $this->header->expects($this->once())
            ->with('Content-Type:text/html; charset=UTF-8');
        $this->subject->defaultAction();
    }

    /**
     * @return void
     */
    public function testExitsEarly()
    {
        $this->exit->expects($this->once());
        $this->subject->defaultAction();
    }
}
