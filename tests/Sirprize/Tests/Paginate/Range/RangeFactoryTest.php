<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
 
namespace Sirprize\Tests\Paginate\Range;

use Sirprize\Paginate\Range\RangeFactory;

class RangeFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testPageRange()
    {
        $rangeFactory = new RangeFactory(3);
        $this->assertInstanceOf('Sirprize\Paginate\Range\PageRange', $rangeFactory->getRange());
    }
    
    public function testIndexRange()
    {
        $rangeFactory = new RangeFactory(null, null, 'items=20-29');
        $this->assertInstanceOf('Sirprize\Paginate\Range\IndexRange', $rangeFactory->getRange());
    }
    
    public function testPrecedence()
    {
        $rangeFactory = new RangeFactory(3, 10, 'items=20-29');
        $this->assertInstanceOf('Sirprize\Paginate\Range\PageRange', $rangeFactory->getRange());
    }
}