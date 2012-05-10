<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Paginate;

/**
 * Paginator - All the info you need in your lists.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
class Paginator
{

    // invalid request
    protected $isOutOfBounds = false;

    // items
    protected $numItems = null;
    protected $numItemsPerPage = null;
    protected $numItemsOnCurrentPage = null;
    protected $firstItemOnCurrentPage = null;
    protected $lastItemOnCurrentPage = null;

    // pages
    protected $numPages = null;
    protected $currentPage = null;
    protected $previousPage = null;
    protected $nextPage = null;
    protected $firstPage = null;
    protected $lastPage = null;

    // indices
    protected $offset = null; // range start index
    protected $last = null; // range end index

    // url stuff
    protected $params = array();
    protected $baseUrl = null;
    protected $pageParam = 'page';

    public function calculateFromCurrentPage($numItems, $currentPage, $numItemsPerPage)
    {
        // num items
        $numItems = ((int)$numItems >= 0) ? (int)$numItems : 0;

        // current page
        $currentPage = ((int)$currentPage > 0) ? (int)$currentPage : 1;

        // items per page
        $numItemsPerPage = ((int)$numItemsPerPage > 0) ? (int)$numItemsPerPage : 10;

        // calculate
        $this->calculate($numItems, $currentPage, $numItemsPerPage);
        return $this;
    }

    public function calculateFromIndexRange($numItems, $offset, $last)
    {
        // check num items
        $numItems = ((int)$numItems >= 0) ? (int)$numItems : 0;

        // check range start index
        $offset = ((int)$offset >= 0) ? (int)$offset : 0;

        // check range end index
        $last = ((int)$last >= $offset) ? (int)$last : $offset + 9;

        // items per page?
        $numItemsPerPage = $last - $offset + 1;

        // current page?
        $currentPage = ceil(($offset + 1) / $numItemsPerPage);

        // calculate
        $this->calculate($numItems, $currentPage, $numItemsPerPage);
        return $this;
    }

    protected function calculate($numItems, $currentPage, $numItemsPerPage)
    {
        $this->isOutOfBounds = ($currentPage > ceil($numItems / $numItemsPerPage));

        if(!$numItems)
        {
            $this->numItems = 0;
            $this->numItemsPerPage = $numItemsPerPage;
            $this->numItemsOnCurrentPage = 0;
            $this->firstItemOnCurrentPage = null;
            $this->lastItemOnCurrentPage = null;
            $this->numPages = 0;
            $this->currentPage = null;
            $this->previousPage = null;
            $this->nextPage = null;
            $this->firsttPage = null;
            $this->lastPage = null;
            $this->offset = null;
            $this->last = null;
            return;
        }

        // pages
        $numPages = ceil($numItems / $numItemsPerPage);
        $currentPage = ($this->isOutOfBounds) ? 1 : $currentPage; // go to page 1 if out of bounds
        $previousPage = ($currentPage == 1) ? $numPages : $currentPage - 1; // flip around if at the beginning
        $nextPage = ($currentPage == $numPages) ? 1 : $currentPage + 1; // flip around if at the end
        $firstPage = 1;
        $lastPage = $numPages;

        // num items on current page
        if($currentPage == $numPages && $currentPage > 1)
        {
            $numItemsOnCurrentPage = $numItems % $numItemsPerPage;
        }
        else if($numItems < $numItemsPerPage)
        {
            $numItemsOnCurrentPage = $numItems;
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
        $this->numItems = (int) $numItems;
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
    }

    public function isOutOfBounds() { return $this->isOutOfBounds; }
    public function getNumItems() { return $this->numItems; }
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

    public function getCurrentPageUrl($argSep = '&')
    {
        return $this->makeUrl($this->getCurrentPage(), $argSep);
    }

    public function getNextPageUrl($argSep = '&')
    {
        return $this->makeUrl($this->getNextPage(), $argSep);
    }

    public function getPreviousPageUrl($argSep = '&')
    {
        return $this->makeUrl($this->getPreviousPage(), $argSep);
    }

    public function getFirstPageUrl($argSep = '&')
    {
        return $this->makeUrl($this->getFirstPage(), $argSep);
    }

    public function getLastPageUrl($argSep = '&')
    {
        return $this->makeUrl($this->getLastPage(), $argSep);
    }

    public function toArray()
    {
        return array(
            'isOutOfBounds' => $this->isOutOfBounds(),
            'numItems' => $this->getNumItems(),
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

    protected function makeUrl($page, $argSep)
    {
        $params = $this->params;

        if($this->getNumItems())
        {
            $params[$this->pageParam] = $page;
        }

        $query = http_build_query($params, '', $argSep);
        return $this->baseUrl.(($query) ? '?'.$query : '');
    }

}