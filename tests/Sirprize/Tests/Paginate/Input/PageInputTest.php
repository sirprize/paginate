<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
 
namespace Sirprize\Tests\Paginate\Input;

use Sirprize\Paginate\Input\PageInput;
use PHPUnit\Framework\TestCase;

class PageInputTest extends TestCase
{
    public function testPage()
    {
        $input = new PageInput(1, 30);
        $this->assertSame(1, $input->getPage());
        $this->assertSame(30, $input->getPerPage());
    }
    
    public function testInvalidPage()
    {
        $input = new PageInput(-10);
        $this->assertSame(1, $input->getPage());
    }
    
    public function testInvalidPerPage()
    {
        $input = new PageInput(1, -10);
        $this->assertSame(20, $input->getPerPage());
    }
    
    public function testExceedingMaxPerPage()
    {
        $input = new PageInput(1, 1000);
        $input->setMaxItems(200);
        $this->assertSame(200, $input->getPerPage());
    }
}