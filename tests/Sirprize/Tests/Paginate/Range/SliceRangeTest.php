<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
namespace Sirprize\Tests\Paginate\Range;

use Sirprize\Paginate\Input\SliceInput;
use Sirprize\Paginate\Range\SliceRange;

class SliceRangeTest extends \PHPUnit_Framework_TestCase
{
    public function test10Items()
    {
        $offset = 0;
        $numItems = 10;
        
        $sliceInput = new SliceInput($offset, $numItems);
        $sliceRange = new SliceRange($sliceInput);
        $this->assertSame(10, $sliceRange->getNumItems(), 'getNumItems()');
        $this->assertSame(0, $sliceRange->getOffset(), 'getOffset()');
        $this->assertSame(9, $sliceRange->getLast(), 'getLast()');
    }

    public function testMoreItems()
    {
        $offset = 10;
        $numItems = 10;

        $sliceInput = new SliceInput($offset, $numItems);
        $sliceRange = new SliceRange($sliceInput);
        $this->assertSame(10, $sliceRange->getNumItems(), 'getNumItems()');
        $this->assertSame(10, $sliceRange->getOffset(), 'getOffset()');
        $this->assertSame(19, $sliceRange->getLast(), 'getLast()');
    }
}