<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
namespace Sirprize\Tests\Paginate;

use Sirprize\Paginate\Paginator;

class PaginatorTest extends \PHPUnit_Framework_TestCase
{

    public function testIndexRangeNoItems()
    {
        $numItems = 0;
        $rangeFirst = 0;
        $rangeLast = 9;

        $paginator = new Paginator();
        $paginator
            ->setBaseUrl('/my-url')
            ->setPageParam('page')
            ->addParam('aa', 'abc')
            ->addParams(array('bb' => 22))
            ->calculateFromIndexRange($numItems, $rangeFirst, $rangeLast)
        ;

        #print_r($paginator->toArray()); exit;
        $this->assertTrue($paginator->isOutOfBounds(), 'isOutOfBounds()');
        $this->assertSame(0, $paginator->getNumItems(), 'getNumItems()');
        $this->assertSame(10, $paginator->getNumItemsPerPage(), 'getNumItemsPerPage()');
        $this->assertSame(0, $paginator->getNumItemsOnCurrentPage(), 'getNumItemsOnCurrentPage()');
        $this->assertNull($paginator->getFirstItemOnCurrentPage(), 'getFirstItemOnCurrentPage()');
        $this->assertNull($paginator->getLastItemOnCurrentPage(), 'getLastItemOnCurrentPage()');
        $this->assertSame(0, $paginator->getNumPages(), 'getNumPages()');
        $this->assertNull($paginator->getCurrentPage(), 'getCurrentPage()');
        $this->assertNull($paginator->getPreviousPage(), 'getPreviousPage()');
        $this->assertNull($paginator->getNextPage(), 'getNextPage()');
        $this->assertNull($paginator->getFirstPage(), 'getFirstPage()');
        $this->assertNull($paginator->getLastPage(), 'getLastPage()');
        $this->assertNull($paginator->getOffset(), 'getOffset()');
        $this->assertNull($paginator->getLast(), 'getLast()');
        $this->assertSame('page', $paginator->getPageParam(), 'getPageParam()');
        $this->assertSame('/my-url', $paginator->getBaseUrl(), 'getBaseUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22', $paginator->getCurrentPageUrl(), 'getCurrentPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22', $paginator->getPreviousPageUrl(), 'getPreviousPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22', $paginator->getNextPageUrl(), 'getNextPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22', $paginator->getFirstPageUrl(), 'getFirstPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22', $paginator->getLastPageUrl(), 'getLastPageUrl()');
    }

    public function testIndexRangeOutOfBoundsItems()
    {
        $numItems = 10;
        $rangeFirst = 10;
        $rangeLast = 19;

        $paginator = new Paginator();
        $paginator
            ->setBaseUrl('/my-url')
            ->setPageParam('page')
            ->addParam('aa', 'abc')
            ->addParams(array('bb' => 22))
            ->calculateFromIndexRange($numItems, $rangeFirst, $rangeLast)
        ;

        #print_r($paginator->toArray()); exit;
        $this->assertTrue($paginator->isOutOfBounds(), 'isOutOfBounds()');
        $this->assertSame(10, $paginator->getNumItems(), 'getNumItems()');
        $this->assertSame(10, $paginator->getNumItemsPerPage(), 'getNumItemsPerPage()');
        $this->assertSame(10, $paginator->getNumItemsOnCurrentPage(), 'getNumItemsOnCurrentPage()');
        $this->assertSame(1, $paginator->getFirstItemOnCurrentPage(), 'getFirstItemOnCurrentPage()');
        $this->assertSame(10, $paginator->getLastItemOnCurrentPage(), 'getLastItemOnCurrentPage()');
        $this->assertSame(1, $paginator->getNumPages(), 'getNumPages()');
        $this->assertSame(1, $paginator->getCurrentPage(), 'getCurrentPage()');
        $this->assertSame(1, $paginator->getPreviousPage(), 'getPreviousPage()');
        $this->assertSame(1, $paginator->getNextPage(), 'getNextPage()');
        $this->assertSame(1, $paginator->getFirstPage(), 'getFirstPage()');
        $this->assertSame(1, $paginator->getLastPage(), 'getLastPage()');
        $this->assertSame(0, $paginator->getOffset(), 'getOffset()');
        $this->assertSame(9, $paginator->getLast(), 'getLast()');
        $this->assertSame('page', $paginator->getPageParam(), 'getPageParam()');
        $this->assertSame('/my-url', $paginator->getBaseUrl(), 'getBaseUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getCurrentPageUrl(), 'getCurrentPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getPreviousPageUrl(), 'getPreviousPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getNextPageUrl(), 'getNextPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getFirstPageUrl(), 'getFirstPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getLastPageUrl(), 'getLastPageUrl()');
    }

    public function testIndexRange10Items()
    {
        $numItems = 10;
        $rangeFirst = 0;
        $rangeLast = 9;

        $paginator = new Paginator();
        $paginator
            ->setBaseUrl('/my-url')
            ->setPageParam('page')
            ->addParam('aa', 'abc')
            ->addParams(array('bb' => 22))
            ->calculateFromIndexRange($numItems, $rangeFirst, $rangeLast)
        ;

        #print_r($paginator->toArray()); exit;
        $this->assertFalse($paginator->isOutOfBounds(), 'isOutOfBounds()');
        $this->assertSame(10, $paginator->getNumItems(), 'getNumItems()');
        $this->assertSame(10, $paginator->getNumItemsPerPage(), 'getNumItemsPerPage()');
        $this->assertSame(10, $paginator->getNumItemsOnCurrentPage(), 'getNumItemsOnCurrentPage()');
        $this->assertSame(1, $paginator->getFirstItemOnCurrentPage(), 'getFirstItemOnCurrentPage()');
        $this->assertSame(10, $paginator->getLastItemOnCurrentPage(), 'getLastItemOnCurrentPage()');
        $this->assertSame(1, $paginator->getNumPages(), 'getNumPages()');
        $this->assertSame(1, $paginator->getCurrentPage(), 'getCurrentPage()');
        $this->assertSame(1, $paginator->getPreviousPage(), 'getPreviousPage()');
        $this->assertSame(1, $paginator->getNextPage(), 'getNextPage()');
        $this->assertSame(1, $paginator->getFirstPage(), 'getFirstPage()');
        $this->assertSame(1, $paginator->getLastPage(), 'getLastPage()');
        $this->assertSame(0, $paginator->getOffset(), 'getOffset()');
        $this->assertSame(9, $paginator->getLast(), 'getLast()');
        $this->assertSame('page', $paginator->getPageParam(), 'getPageParam()');
        $this->assertSame('/my-url', $paginator->getBaseUrl(), 'getBaseUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getCurrentPageUrl(), 'getCurrentPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getPreviousPageUrl(), 'getPreviousPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getNextPageUrl(), 'getNextPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getFirstPageUrl(), 'getFirstPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getLastPageUrl(), 'getLastPageUrl()');
    }

    public function testIndexRangeLessItemsThanItemsPerPage()
    {
        $numItems = 2;
        $rangeFirst = 0;
        $rangeLast = 9;

        $paginator = new Paginator();
        $paginator
            ->setBaseUrl('/my-url')
            ->setPageParam('page')
            ->addParam('aa', 'abc')
            ->addParams(array('bb' => 22))
            ->calculateFromIndexRange($numItems, $rangeFirst, $rangeLast)
        ;

        #print_r($paginator->toArray()); exit;
        $this->assertFalse($paginator->isOutOfBounds(), 'isOutOfBounds()');
        $this->assertSame(2, $paginator->getNumItems(), 'getNumItems()');
        $this->assertSame(10, $paginator->getNumItemsPerPage(), 'getNumItemsPerPage()');
        $this->assertSame(2, $paginator->getNumItemsOnCurrentPage(), 'getNumItemsOnCurrentPage()');
        $this->assertSame(1, $paginator->getFirstItemOnCurrentPage(), 'getFirstItemOnCurrentPage()');
        $this->assertSame(2, $paginator->getLastItemOnCurrentPage(), 'getLastItemOnCurrentPage()');
        $this->assertSame(1, $paginator->getNumPages(), 'getNumPages()');
        $this->assertSame(1, $paginator->getCurrentPage(), 'getCurrentPage()');
        $this->assertSame(1, $paginator->getPreviousPage(), 'getPreviousPage()');
        $this->assertSame(1, $paginator->getNextPage(), 'getNextPage()');
        $this->assertSame(1, $paginator->getFirstPage(), 'getFirstPage()');
        $this->assertSame(1, $paginator->getLastPage(), 'getLastPage()');
        $this->assertSame(0, $paginator->getOffset(), 'getOffset()');
        $this->assertSame(1, $paginator->getLast(), 'getLast()');
        $this->assertSame('page', $paginator->getPageParam(), 'getPageParam()');
        $this->assertSame('/my-url', $paginator->getBaseUrl(), 'getBaseUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getCurrentPageUrl(), 'getCurrentPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getPreviousPageUrl(), 'getPreviousPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getNextPageUrl(), 'getNextPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getFirstPageUrl(), 'getFirstPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getLastPageUrl(), 'getLastPageUrl()');
    }

    public function testIndexRange15ItemsAndOnPage2()
    {
        $numItems = 15;
        $rangeFirst = 10;
        $rangeLast = 19;

        $paginator = new Paginator();
        $paginator
            ->setBaseUrl('/my-url')
            ->setPageParam('page')
            ->addParam('aa', 'abc')
            ->addParams(array('bb' => 22))
            ->calculateFromIndexRange($numItems, $rangeFirst, $rangeLast)
        ;

        #print_r($paginator->toArray()); exit;
        $this->assertFalse($paginator->isOutOfBounds(), 'isOutOfBounds()');
        $this->assertSame(15, $paginator->getNumItems(), 'getNumItems()');
        $this->assertSame(10, $paginator->getNumItemsPerPage(), 'getNumItemsPerPage()');
        $this->assertSame(5, $paginator->getNumItemsOnCurrentPage(), 'getNumItemsOnCurrentPage()');
        $this->assertSame(11, $paginator->getFirstItemOnCurrentPage(), 'getFirstItemOnCurrentPage()');
        $this->assertSame(15, $paginator->getLastItemOnCurrentPage(), 'getLastItemOnCurrentPage()');
        $this->assertSame(2, $paginator->getNumPages(), 'getNumPages()');
        $this->assertSame(2, $paginator->getCurrentPage(), 'getCurrentPage()');
        $this->assertSame(1, $paginator->getPreviousPage(), 'getPreviousPage()');
        $this->assertSame(1, $paginator->getNextPage(), 'getNextPage()');
        $this->assertSame(1, $paginator->getFirstPage(), 'getFirstPage()');
        $this->assertSame(2, $paginator->getLastPage(), 'getLastPage()');
        $this->assertSame(10, $paginator->getOffset(), 'getOffset()');
        $this->assertSame(14, $paginator->getLast(), 'getLast()');
        $this->assertSame('page', $paginator->getPageParam(), 'getPageParam()');
        $this->assertSame('/my-url', $paginator->getBaseUrl(), 'getBaseUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=2', $paginator->getCurrentPageUrl(), 'getCurrentPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getPreviousPageUrl(), 'getPreviousPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getNextPageUrl(), 'getNextPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getFirstPageUrl(), 'getFirstPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=2', $paginator->getLastPageUrl(), 'getLastPageUrl()');
    }

    public function testIndexRange123ItemsAndOnPage5()
    {
        $numItems = 123;
        $rangeFirst = 40;
        $rangeLast = 49;

        $paginator = new Paginator();
        $paginator
            ->setBaseUrl('/my-url')
            ->setPageParam('page')
            ->addParam('aa', 'abc')
            ->addParams(array('bb' => 22))
            ->calculateFromIndexRange($numItems, $rangeFirst, $rangeLast)
        ;

        #print_r($paginator->toArray()); exit;
        $this->assertFalse($paginator->isOutOfBounds(), 'isOutOfBounds()');
        $this->assertSame(123, $paginator->getNumItems(), 'getNumItems()');
        $this->assertSame(10, $paginator->getNumItemsPerPage(), 'getNumItemsPerPage()');
        $this->assertSame(10, $paginator->getNumItemsOnCurrentPage(), 'getNumItemsOnCurrentPage()');
        $this->assertSame(41, $paginator->getFirstItemOnCurrentPage(), 'getFirstItemOnCurrentPage()');
        $this->assertSame(50, $paginator->getLastItemOnCurrentPage(), 'getLastItemOnCurrentPage()');
        $this->assertSame(13, $paginator->getNumPages(), 'getNumPages()');
        $this->assertSame(5, $paginator->getCurrentPage(), 'getCurrentPage()');
        $this->assertSame(4, $paginator->getPreviousPage(), 'getPreviousPage()');
        $this->assertSame(6, $paginator->getNextPage(), 'getNextPage()');
        $this->assertSame(1, $paginator->getFirstPage(), 'getFirstPage()');
        $this->assertSame(13, $paginator->getLastPage(), 'getLastPage()');
        $this->assertSame(40, $paginator->getOffset(), 'getOffset()');
        $this->assertSame(49, $paginator->getLast(), 'getLast()');
        $this->assertSame('page', $paginator->getPageParam(), 'getPageParam()');
        $this->assertSame('/my-url', $paginator->getBaseUrl(), 'getBaseUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=5', $paginator->getCurrentPageUrl(), 'getCurrentPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=4', $paginator->getPreviousPageUrl(), 'getPreviousPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=6', $paginator->getNextPageUrl(), 'getNextPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getFirstPageUrl(), 'getFirstPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=13', $paginator->getLastPageUrl(), 'getLastPageUrl()');
    }

    public function testCurrentPageNoItems()
    {
        $numItems = 0;
        $currentPage = 1;
        $numItemsPerPage = 10;

        $paginator = new Paginator();
        $paginator
            ->setBaseUrl('/my-url')
            ->setPageParam('page')
            ->addParam('aa', 'abc')
            ->addParams(array('bb' => 22))
            ->calculateFromCurrentPage($numItems, $currentPage, $numItemsPerPage)
        ;

        #print_r($paginator->toArray()); exit;
        $this->assertTrue($paginator->isOutOfBounds(), 'isOutOfBounds()');
        $this->assertSame(0, $paginator->getNumItems(), 'getNumItems()');
        $this->assertSame(10, $paginator->getNumItemsPerPage(), 'getNumItemsPerPage()');
        $this->assertSame(0, $paginator->getNumItemsOnCurrentPage(), 'getNumItemsOnCurrentPage()');
        $this->assertNull($paginator->getFirstItemOnCurrentPage(), 'getFirstItemOnCurrentPage()');
        $this->assertNull($paginator->getLastItemOnCurrentPage(), 'getLastItemOnCurrentPage()');
        $this->assertSame(0, $paginator->getNumPages(), 'getNumPages()');
        $this->assertNull($paginator->getCurrentPage(), 'getCurrentPage()');
        $this->assertNull($paginator->getPreviousPage(), 'getPreviousPage()');
        $this->assertNull($paginator->getNextPage(), 'getNextPage()');
        $this->assertNull($paginator->getFirstPage(), 'getFirstPage()');
        $this->assertNull($paginator->getLastPage(), 'getLastPage()');
        $this->assertNull($paginator->getOffset(), 'getOffset()');
        $this->assertNull($paginator->getLast(), 'getLast()');
        $this->assertSame('page', $paginator->getPageParam(), 'getPageParam()');
        $this->assertSame('/my-url', $paginator->getBaseUrl(), 'getBaseUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22', $paginator->getCurrentPageUrl(), 'getCurrentPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22', $paginator->getPreviousPageUrl(), 'getPreviousPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22', $paginator->getNextPageUrl(), 'getNextPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22', $paginator->getFirstPageUrl(), 'getFirstPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22', $paginator->getLastPageUrl(), 'getLastPageUrl()');
    }

    public function testCurrentPageOutOfBounds()
    {
        $numItems = 10;
        $currentPage = 2;
        $numItemsPerPage = 10;

        $paginator = new Paginator();
        $paginator
            ->setBaseUrl('/my-url')
            ->setPageParam('page')
            ->addParam('aa', 'abc')
            ->addParams(array('bb' => 22))
            ->calculateFromCurrentPage($numItems, $currentPage, $numItemsPerPage)
        ;

        #print_r($paginator->toArray()); exit;
        $this->assertTrue($paginator->isOutOfBounds(), 'isOutOfBounds()');
        $this->assertSame(10, $paginator->getNumItems(), 'getNumItems()');
        $this->assertSame(10, $paginator->getNumItemsPerPage(), 'getNumItemsPerPage()');
        $this->assertSame(10, $paginator->getNumItemsOnCurrentPage(), 'getNumItemsOnCurrentPage()');
        $this->assertSame(1, $paginator->getFirstItemOnCurrentPage(), 'getFirstItemOnCurrentPage()');
        $this->assertSame(10, $paginator->getLastItemOnCurrentPage(), 'getLastItemOnCurrentPage()');
        $this->assertSame(1, $paginator->getNumPages(), 'getNumPages()');
        $this->assertSame(1, $paginator->getCurrentPage(), 'getCurrentPage()');
        $this->assertSame(1, $paginator->getPreviousPage(), 'getPreviousPage()');
        $this->assertSame(1, $paginator->getNextPage(), 'getNextPage()');
        $this->assertSame(1, $paginator->getFirstPage(), 'getFirstPage()');
        $this->assertSame(1, $paginator->getLastPage(), 'getLastPage()');
        $this->assertSame(0, $paginator->getOffset(), 'getOffset()');
        $this->assertSame(9, $paginator->getLast(), 'getLast()');
        $this->assertSame('page', $paginator->getPageParam(), 'getPageParam()');
        $this->assertSame('/my-url', $paginator->getBaseUrl(), 'getBaseUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getCurrentPageUrl(), 'getCurrentPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getPreviousPageUrl(), 'getPreviousPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getNextPageUrl(), 'getNextPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getFirstPageUrl(), 'getFirstPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getLastPageUrl(), 'getLastPageUrl()');
    }

    public function testCurrentPage10Items()
    {
        $numItems = 10;
        $currentPage = 1;
        $numItemsPerPage = 10;

        $paginator = new Paginator();
        $paginator
            ->setBaseUrl('/my-url')
            ->setPageParam('page')
            ->addParam('aa', 'abc')
            ->addParams(array('bb' => 22))
            ->calculateFromCurrentPage($numItems, $currentPage, $numItemsPerPage)
        ;

        #print_r($paginator->toArray()); exit;
        $this->assertFalse($paginator->isOutOfBounds(), 'isOutOfBounds()');
        $this->assertSame(10, $paginator->getNumItems(), 'getNumItems()');
        $this->assertSame(10, $paginator->getNumItemsPerPage(), 'getNumItemsPerPage()');
        $this->assertSame(10, $paginator->getNumItemsOnCurrentPage(), 'getNumItemsOnCurrentPage()');
        $this->assertSame(1, $paginator->getFirstItemOnCurrentPage(), 'getFirstItemOnCurrentPage()');
        $this->assertSame(10, $paginator->getLastItemOnCurrentPage(), 'getLastItemOnCurrentPage()');
        $this->assertSame(1, $paginator->getNumPages(), 'getNumPages()');
        $this->assertSame(1, $paginator->getCurrentPage(), 'getCurrentPage()');
        $this->assertSame(1, $paginator->getPreviousPage(), 'getPreviousPage()');
        $this->assertSame(1, $paginator->getNextPage(), 'getNextPage()');
        $this->assertSame(1, $paginator->getFirstPage(), 'getFirstPage()');
        $this->assertSame(1, $paginator->getLastPage(), 'getLastPage()');
        $this->assertSame(0, $paginator->getOffset(), 'getOffset()');
        $this->assertSame(9, $paginator->getLast(), 'getLast()');
        $this->assertSame('page', $paginator->getPageParam(), 'getPageParam()');
        $this->assertSame('/my-url', $paginator->getBaseUrl(), 'getBaseUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getCurrentPageUrl(), 'getCurrentPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getPreviousPageUrl(), 'getPreviousPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getNextPageUrl(), 'getNextPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getFirstPageUrl(), 'getFirstPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getLastPageUrl(), 'getLastPageUrl()');
    }

    public function testCurrentPage15ItemsAndOnPage2()
    {
        $numItems = 15;
        $currentPage = 2;
        $numItemsPerPage = 10;

        $paginator = new Paginator();
        $paginator
            ->setBaseUrl('/my-url')
            ->setPageParam('page')
            ->addParam('aa', 'abc')
            ->addParams(array('bb' => 22))
            ->calculateFromCurrentPage($numItems, $currentPage, $numItemsPerPage)
        ;

        #print_r($paginator->toArray()); exit;
        $this->assertFalse($paginator->isOutOfBounds(), 'isOutOfBounds()');
        $this->assertSame(15, $paginator->getNumItems(), 'getNumItems()');
        $this->assertSame(10, $paginator->getNumItemsPerPage(), 'getNumItemsPerPage()');
        $this->assertSame(5, $paginator->getNumItemsOnCurrentPage(), 'getNumItemsOnCurrentPage()');
        $this->assertSame(11, $paginator->getFirstItemOnCurrentPage(), 'getFirstItemOnCurrentPage()');
        $this->assertSame(15, $paginator->getLastItemOnCurrentPage(), 'getLastItemOnCurrentPage()');
        $this->assertSame(2, $paginator->getNumPages(), 'getNumPages()');
        $this->assertSame(2, $paginator->getCurrentPage(), 'getCurrentPage()');
        $this->assertSame(1, $paginator->getPreviousPage(), 'getPreviousPage()');
        $this->assertSame(1, $paginator->getNextPage(), 'getNextPage()');
        $this->assertSame(1, $paginator->getFirstPage(), 'getFirstPage()');
        $this->assertSame(2, $paginator->getLastPage(), 'getLastPage()');
        $this->assertSame(10, $paginator->getOffset(), 'getOffset()');
        $this->assertSame(14, $paginator->getLast(), 'getLast()');
        $this->assertSame('page', $paginator->getPageParam(), 'getPageParam()');
        $this->assertSame('/my-url', $paginator->getBaseUrl(), 'getBaseUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=2', $paginator->getCurrentPageUrl(), 'getCurrentPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getPreviousPageUrl(), 'getPreviousPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getNextPageUrl(), 'getNextPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getFirstPageUrl(), 'getFirstPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=2', $paginator->getLastPageUrl(), 'getLastPageUrl()');
    }

    public function testCurrentPage123ItemsAndOnPage5()
    {
        $numItems = 123;
        $currentPage = 5;
        $numItemsPerPage = 10;

        $paginator = new Paginator();
        $paginator
            ->setBaseUrl('/my-url')
            ->setPageParam('page')
            ->addParam('aa', 'abc')
            ->addParams(array('bb' => 22))
            ->calculateFromCurrentPage($numItems, $currentPage, $numItemsPerPage)
        ;

        #print_r($paginator->toArray()); exit;
        $this->assertFalse($paginator->isOutOfBounds(), 'isOutOfBounds()');
        $this->assertSame(123, $paginator->getNumItems(), 'getNumItems()');
        $this->assertSame(10, $paginator->getNumItemsPerPage(), 'getNumItemsPerPage()');
        $this->assertSame(10, $paginator->getNumItemsOnCurrentPage(), 'getNumItemsOnCurrentPage()');
        $this->assertSame(41, $paginator->getFirstItemOnCurrentPage(), 'getFirstItemOnCurrentPage()');
        $this->assertSame(50, $paginator->getLastItemOnCurrentPage(), 'getLastItemOnCurrentPage()');
        $this->assertSame(13, $paginator->getNumPages(), 'getNumPages()');
        $this->assertSame(5, $paginator->getCurrentPage(), 'getCurrentPage()');
        $this->assertSame(4, $paginator->getPreviousPage(), 'getPreviousPage()');
        $this->assertSame(6, $paginator->getNextPage(), 'getNextPage()');
        $this->assertSame(1, $paginator->getFirstPage(), 'getFirstPage()');
        $this->assertSame(13, $paginator->getLastPage(), 'getLastPage()');
        $this->assertSame(40, $paginator->getOffset(), 'getOffset()');
        $this->assertSame(49, $paginator->getLast(), 'getLast()');
        $this->assertSame('page', $paginator->getPageParam(), 'getPageParam()');
        $this->assertSame('/my-url', $paginator->getBaseUrl(), 'getBaseUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=5', $paginator->getCurrentPageUrl(), 'getCurrentPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=4', $paginator->getPreviousPageUrl(), 'getPreviousPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=6', $paginator->getNextPageUrl(), 'getNextPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=1', $paginator->getFirstPageUrl(), 'getFirstPageUrl()');
        $this->assertSame('/my-url?aa=abc&bb=22&page=13', $paginator->getLastPageUrl(), 'getLastPageUrl()');
    }

    public function testAddParam()
    {
        $paginator = new Paginator();
        $paginator->addParam('aa', 'AA');

        $this->assertSame('AA', $paginator->getParam('aa'), 'getParam("aa")');
    }

    public function testAddParams()
    {
        $paginator = new Paginator();
        $paginator->addParams(array('aa' => 'AA'));
        $paginator->addParams(array('bb' => 'BB'));

        $this->assertSame('AA', $paginator->getParam('aa'), 'getParam("aa")');
        $this->assertSame('BB', $paginator->getParam('bb'), 'getParam("bb")');
    }

    public function testSetParams()
    {
        $paginator = new Paginator();
        $paginator->setParams(array('aa' => 'AA'));
        $paginator->setParams(array('bb' => 'BB'));

        $this->assertNull($paginator->getParam('aa'), 'getParam("aa")');
        $this->assertSame('BB', $paginator->getParam('bb'), 'getParam("bb")');
    }

    public function testSetters()
    {
        $paginator = new Paginator();

        $this->assertInstanceOf('\Sirprize\Paginate\Paginator', $paginator->addParams(array('aa' => 'AA')), 'addParams(array("aa" => "AA"))');
        $this->assertInstanceOf('\Sirprize\Paginate\Paginator', $paginator->setParams(array('aa' => 'AA')), 'getParams(array("aa" => "AA"))');
        $this->assertInstanceOf('\Sirprize\Paginate\Paginator', $paginator->addParam('aa', 'AA'), 'addParam("aa", "AA")');
        $this->assertInstanceOf('\Sirprize\Paginate\Paginator', $paginator->setPageParam('page'), 'setPageParam("page")');
        $this->assertInstanceOf('\Sirprize\Paginate\Paginator', $paginator->setBaseUrl('/my-url'), 'setBaseUrl("/my-url")');
    }

    public function testGetters()
    {
        $paginator = new Paginator();
        $paginator
            ->setPageParam('page')
            ->addParam('page', 10) // must not make it into getParams()
            ->setBaseUrl('/my-url')
            ->addParam('aa', 'AA')
        ;

        $this->assertNull($paginator->getParam('page'), 'getParam("page")');
        $this->assertSame('page', $paginator->getPageParam(), 'getPageParam()');
        $this->assertSame('/my-url', $paginator->getBaseUrl(), 'getBaseUrl()');
        $this->assertArrayHasKey('aa', $paginator->getParams(), 'getParams()');
        $this->assertArrayHasKey('isOutOfBounds', $paginator->toArray(), 'toArray()');
    }

}