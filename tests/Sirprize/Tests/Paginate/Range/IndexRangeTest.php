<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
namespace Sirprize\Tests\Paginate\Range;

use Sirprize\Paginate\Input\IndexInput;
use Sirprize\Paginate\Range\IndexRange;

class IndexRangeTest extends \PHPUnit_Framework_TestCase
{

    public function test10Items()
    {
        $offset = 0;
        $last = 9;
        
        $indexRangeInput = new IndexInput($offset, $last);
        $indexRange = new IndexRange($indexRangeInput);
        $this->assertSame(10, $indexRange->getNumItems(), 'getNumItems()');
        $this->assertSame(0, $indexRange->getOffset(), 'getOffset()');
        $this->assertSame(9, $indexRange->getLast(), 'getLast()');
    }

    public function testMoreItems()
    {
        $offset = 10;
        $last = 19;

        $indexRangeInput = new IndexInput($offset, $last);
        $indexRange = new IndexRange($indexRangeInput);
        $this->assertSame(10, $indexRange->getNumItems(), 'getNumItems()');
        $this->assertSame(10, $indexRange->getOffset(), 'getOffset()');
        $this->assertSame(19, $indexRange->getLast(), 'getLast()');
    }
}