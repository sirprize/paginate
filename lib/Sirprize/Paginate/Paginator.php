<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Paginate;

use Sirprize\Paginate\Range\PageRange;

/**
 * Paginator.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
class Paginator
{

    // invalid request
    protected $isOutOfBounds = false;

    // items
    protected $totalItems = 0;
    protected $numItemsPerPage = null;
    protected $numItemsOnCurrentPage = 0;
    protected $firstItemOnCurrentPage = null; // starts at 1
    protected $lastItemOnCurrentPage = null;

    // pages
    protected $numPages = 0;
    protected $currentPage = null;
    protected $previousPage = null;
    protected $nextPage = null;
    protected $firstPage = null;
    protected $lastPage = null;

    // indices
    protected $offset = null; // starts at 0
    protected $last = null;

    // url stuff
    protected $params = array();
    protected $baseUrl = null;
    protected $pageParam = 'page';
    
    public function __construct(PageRange $pageRange)
    {
        $currentPage = $pageRange->getCurrentPage();
        $numItemsPerPage = $pageRange->getNumItems();
        $totalItems = $pageRange->getTotalItems();
        
        if(!$totalItems)
        {
            $this->isOutOfBounds = true;
            $this->numItemsPerPage = $numItemsPerPage;
            return;
        }
        
        $isOutOfBounds = ($currentPage > ceil($totalItems / $numItemsPerPage));
        
        // pages
        $numPages = ceil($totalItems / $numItemsPerPage);
        $currentPage = ($isOutOfBounds) ? 1 : $currentPage; // go to page 1 if out of bounds
        $previousPage = ($currentPage == 1) ? $numPages : $currentPage - 1; // flip around if at the beginning
        $nextPage = ($currentPage == $numPages) ? 1 : $currentPage + 1; // flip around if at the end
        $firstPage = 1;
        $lastPage = $numPages;

        // num items on current page
        if($currentPage == $numPages && $currentPage > 1)
        {
            $numItemsOnCurrentPage = $totalItems % $numItemsPerPage;
        }
        else if($totalItems < $numItemsPerPage)
        {
            $numItemsOnCurrentPage = $totalItems;
        }
        else {
            $numItemsOnCurrentPage = $numItemsPerPage;
        }

        // indices (start at 0)
        $offset = ($currentPage - 1) * $numItemsPerPage;
        $last = $offset + $numItemsOnCurrentPage - 1;

        // items
        $firstItemOnCurrentPage = $offset + 1;
        $lastItemOnCurrentPage = $last + 1;

        // set instance vars
        $this->isOutOfBounds = $isOutOfBounds;
        $this->totalItems = (int) $totalItems;
        $this->numItemsPerPage = (int) $numItemsPerPage;
        $this->numItemsOnCurrentPage = (int) $numItemsOnCurrentPage;
        $this->firstItemOnCurrentPage = (int) $firstItemOnCurrentPage;
        $this->lastItemOnCurrentPage = (int) $lastItemOnCurrentPage;
        $this->numPages = (int) $numPages;
        $this->currentPage = (int) $currentPage;
        $this->previousPage = (int) $previousPage;
        $this->nextPage = (int) $nextPage;
        $this->firstPage = (int) $firstPage;
        $this->lastPage = (int) $lastPage;
        $this->offset = (int) $offset;
        $this->last = (int) $last;
        return $this;
    }

    public function getNumItems() { return $this->getNumItemsPerPage(); }
    public function isOutOfBounds() { return $this->isOutOfBounds; }
    public function getTotalItems() { return $this->totalItems; }
    public function getNumItemsPerPage() { return $this->numItemsPerPage; }
    public function getNumItemsOnCurrentPage() { return $this->numItemsOnCurrentPage; }
    public function getFirstItemOnCurrentPage() { return $this->firstItemOnCurrentPage; }
    public function getLastItemOnCurrentPage() { return $this->lastItemOnCurrentPage; }

    public function getNumPages() { return $this->numPages; }
    public function getCurrentPage() { return $this->currentPage; }
    public function getPreviousPage() { return $this->previousPage; }
    public function getNextPage() { return $this->nextPage; }
    public function getFirstPage() { return $this->firstPage; }
    public function getLastPage() { return $this->lastPage; }

    public function getOffset() { return $this->offset; }
    public function getLast() { return $this->last; }

    public function setParams(array $params)
    {
        $this->params = array();
        $this->addParams($params);
        return $this;
    }

    public function addParam($param, $value)
    {
        if(strtoLower($param) == strtoLower($this->pageParam))
        {
            return $this;
        }

        $this->params[$param] = $value;
        return $this;
    }

    public function addParams(array $params)
    {
        foreach($params as $param => $value)
        {
            $this->addParam($param, $value);
        }

        return $this;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getParam($param)
    {
        return (isset($this->params[$param])) ? $this->params[$param] : null;
    }

    public function setPageParam($pageParam)
    {
        $this->pageParam = $pageParam;
        return $this;
    }

    public function getPageParam()
    {
        return $this->pageParam;
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function getCurrentPageUrl($argSep = '&', $params = array())
    {
        return $this->makeUrl($this->getCurrentPage(), $argSep, $params);
    }

    public function getNextPageUrl($argSep = '&', $params = array())
    {
        return $this->makeUrl($this->getNextPage(), $argSep, $params);
    }

    public function getPreviousPageUrl($argSep = '&', $params = array())
    {
        return $this->makeUrl($this->getPreviousPage(), $argSep, $params);
    }

    public function getFirstPageUrl($argSep = '&', $params = array())
    {
        return $this->makeUrl($this->getFirstPage(), $argSep, $params);
    }

    public function getLastPageUrl($argSep = '&', $params = array())
    {
        return $this->makeUrl($this->getLastPage(), $argSep, $params);
    }

    public function toArray()
    {
        return array(
            'isOutOfBounds' => $this->isOutOfBounds(),
            'totalItems' => $this->getTotalItems(),
            'numItemsPerPage' => $this->getNumItemsPerPage(),
            'numItemsOnCurrentPage' => $this->getNumItemsOnCurrentPage(),
            'firstItemOnCurrentPage' => $this->getFirstItemOnCurrentPage(),
            'lastItemOnCurrentPage' => $this->getLastItemOnCurrentPage(),
            'numPages' => $this->getNumPages(),
            'currentPage' => $this->getCurrentPage(),
            'previousPage' => $this->getPreviousPage(),
            'nextPage' => $this->getNextPage(),
            'firstPage' => $this->getFirstPage(),
            'lastPage' => $this->getLastPage(),
            'offset' => $this->getOffset(),
            'last' => $this->getLast(),
            'currentPageUrl' => $this->getCurrentPageUrl(),
            'nextPageUrl' => $this->getNextPageUrl(),
            'previousPageUrl' => $this->getPreviousPageUrl(),
            'firstPageUrl' => $this->getFirstPageUrl(),
            'lastPageUrl' => $this->getLastPageUrl(),
            'baseUrl' => $this->getBaseUrl(),
            'pageParam' => $this->getPageParam()
        );
    }

    protected function makeUrl($page, $argSep, $params)
    {
        if($params !== false)
        {
            $params = $this->params;
        }

        if($this->getTotalItems())
        {
            $params[$this->pageParam] = $page;
        }

        $query = http_build_query($params, '', $argSep);
        return $this->baseUrl.(($query) ? '?'.$query : '');
    }

}