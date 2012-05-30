<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Paginate;

/**
 * IndexRangePaginator.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
class IndexRangePaginator extends AbstractPaginator implements PaginatorInterface
{

    protected $currentPageInput = null;
    protected $numItemsPerPageInput = null;
    
    public function __construct($offset, $last)
    {
        // check range start index
        $offset = ((int) $offset >= 0) ? (int) $offset : 0;

        // check range end index
        $last = ((int) $last >= $offset) ? (int) $last : $offset + 9;

        // items per page?
        $this->numItemsPerPageInput = $last - $offset + 1;

        // current page?
        $this->currentPageInput = ceil(($offset + 1) / $this->numItemsPerPageInput);
    }
    
    public function start($numItems)
    {
        $numItems = ((int) $numItems >= 0) ? (int) $numItems : 0;
        $this->calculate($numItems, $this->currentPageInput, $this->numItemsPerPageInput);
        return $this;
    }
}