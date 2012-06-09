<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
 
namespace Sirprize\Tests\Paginate\Input;

use Sirprize\Paginate\Input\RangeHeaderInput;

class RangeHeaderInputTest extends \PHPUnit_Framework_TestCase
{
    public function testIndexRange()
    {
        $input = new RangeHeaderInput('items=0-9');
        $this->assertSame(0, $input->getOffset());
        $this->assertSame(9, $input->getLast());
    }
    
    public function testInvalidInput()
    {
        $input = new RangeHeaderInput('');
        $input->setDefaultNumItems(20);
        $this->assertSame(0, $input->getOffset());
        $this->assertSame(19, $input->getLast());
    }
    
    public function testInvalidLast()
    {
        $input = new RangeHeaderInput('items=10-9');
        $input->setDefaultNumItems(20);
        $this->assertSame(10, $input->getOffset());
        $this->assertSame(29, $input->getLast());
    }
    
    public function testExceedingMaxPerPage()
    {
        $input = new RangeHeaderInput('items=0-1000');
        $input->setMaxItems(100);
        $this->assertSame(0, $input->getOffset());
        $this->assertSame(99, $input->getLast());
    }
}