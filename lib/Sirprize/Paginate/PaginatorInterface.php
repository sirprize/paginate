<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Paginate;

/**
 * PaginatorInterface.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
interface PaginatorInterface
{
    public function start($numItems);
    /*
    public function isOutOfBounds();
    public function getNumItems();
    public function getNumItemsPerPage();
    public function getNumItemsOnCurrentPage();
    public function getFirstItemOnCurrentPage();
    public function getLastItemOnCurrentPage();

    public function getNumPages();
    public function getCurrentPage();
    public function getPreviousPage();
    public function getNextPage();
    public function getFirstPage();
    public function getLastPage();

    public function getOffset();
    public function getLast();

    public function setParams(array $params);
    public function addParam($param, $value);
    public function addParams(array $params);
    public function getParams();
    public function getParam($param);
    public function setPageParam($pageParam);
    public function getPageParam();
    public function setBaseUrl($baseUrl);
    public function getBaseUrl();
    public function getCurrentPageUrl($argSep = '&');
    public function getNextPageUrl($argSep = '&');
    public function getPreviousPageUrl($argSep = '&');
    public function getFirstPageUrl($argSep = '&');
    public function getLastPageUrl($argSep = '&');
    public function toArray();
    */
}