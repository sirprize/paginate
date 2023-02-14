<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
namespace Sirprize\Tests\Paginate\Range;

use Sirprize\Paginate\Input\PageInput;
use Sirprize\Paginate\Range\PageRange;
use PHPUnit\Framework\TestCase;

class PageRangeTest extends TestCase
{
    public function testFirstPage()
    {
        $currentPage = 1;
        $numItemsPerPage = 10;
        
        $currentPageInput = new PageInput($currentPage, $numItemsPerPage);
        $pageRange = new PageRange($currentPageInput);
        $this->assertSame(10, $pageRange->getNumItems(), 'getNumItems()');
        $this->assertSame(0, $pageRange->getOffset(), 'getOffset()');
        $this->assertSame(9, $pageRange->getLast(), 'getLast()');
    }
    
    public function testSecondPge()
    {
        $currentPage = 2;
        $numItemsPerPage = 10;

        $currentPageInput = new PageInput($currentPage, $numItemsPerPage);
        $pageRange = new PageRange($currentPageInput);
        $this->assertSame(10, $pageRange->getNumItems(), 'getNumItems()');
        $this->assertSame(10, $pageRange->getOffset(), 'getOffset()');
        $this->assertSame(19, $pageRange->getLast(), 'getLast()');
    }
}