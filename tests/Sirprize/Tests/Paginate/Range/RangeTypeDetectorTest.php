<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
 
namespace Sirprize\Tests\Paginate\Range;

use Sirprize\Paginate\Range\RangeTypeDetector;

class RangeTypeDetectorTest extends \PHPUnit_Framework_TestCase
{
    public function testPageRange()
    {
        $rangeTypeDetector = new RangeTypeDetector(3);
        $this->assertInstanceOf('Sirprize\Paginate\Range\PageRange', $rangeTypeDetector->getRange());
    }
    
    public function testIndexRange()
    {
        $rangeTypeDetector = new RangeTypeDetector(null, null, 'items=20-29');
        $this->assertInstanceOf('Sirprize\Paginate\Range\IndexRange', $rangeTypeDetector->getRange());
    }
    
    public function testPrecedence()
    {
        $rangeTypeDetector = new RangeTypeDetector(3, 10, 'items=20-29');
        $this->assertInstanceOf('Sirprize\Paginate\Range\PageRange', $rangeTypeDetector->getRange());
    }
}