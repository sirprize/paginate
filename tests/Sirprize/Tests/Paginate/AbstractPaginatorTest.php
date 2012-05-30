<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
namespace Sirprize\Tests\Paginate;

use Sirprize\Paginate\AbstractPaginator;

class AbstractPaginatorTest extends \PHPUnit_Framework_TestCase
{

    public function testAddParam()
    {
        $paginator = $this->getMockForAbstractClass('Sirprize\Paginate\AbstractPaginator');
        $paginator->addParam('aa', 'AA');

        $this->assertSame('AA', $paginator->getParam('aa'), 'getParam("aa")');
    }

    public function testAddParams()
    {
        $paginator = $this->getMockForAbstractClass('Sirprize\Paginate\AbstractPaginator');
        $paginator->addParams(array('aa' => 'AA'));
        $paginator->addParams(array('bb' => 'BB'));

        $this->assertSame('AA', $paginator->getParam('aa'), 'getParam("aa")');
        $this->assertSame('BB', $paginator->getParam('bb'), 'getParam("bb")');
    }

    public function testSetParams()
    {
        $paginator = $this->getMockForAbstractClass('Sirprize\Paginate\AbstractPaginator');
        $paginator->setParams(array('aa' => 'AA'));
        $paginator->setParams(array('bb' => 'BB'));

        $this->assertNull($paginator->getParam('aa'), 'getParam("aa")');
        $this->assertSame('BB', $paginator->getParam('bb'), 'getParam("bb")');
    }

    public function testSetters()
    {
        $paginator = $this->getMockForAbstractClass('Sirprize\Paginate\AbstractPaginator');
        $this->assertInstanceOf('Sirprize\Paginate\AbstractPaginator', $paginator->addParams(array('aa' => 'AA')), 'addParams(array("aa" => "AA"))');
        $this->assertInstanceOf('Sirprize\Paginate\AbstractPaginator', $paginator->setParams(array('aa' => 'AA')), 'getParams(array("aa" => "AA"))');
        $this->assertInstanceOf('Sirprize\Paginate\AbstractPaginator', $paginator->addParam('aa', 'AA'), 'addParam("aa", "AA")');
        $this->assertInstanceOf('Sirprize\Paginate\AbstractPaginator', $paginator->setPageParam('page'), 'setPageParam("page")');
        $this->assertInstanceOf('Sirprize\Paginate\AbstractPaginator', $paginator->setBaseUrl('/my-url'), 'setBaseUrl("/my-url")');
    }

    public function testGetters()
    {
        $paginator = $this->getMockForAbstractClass('Sirprize\Paginate\AbstractPaginator');
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