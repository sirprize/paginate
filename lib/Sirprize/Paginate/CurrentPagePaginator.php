<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Paginate;

/**
 * CurrentPagePaginator.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
class CurrentPagePaginator extends AbstractPaginator implements PaginatorInterface
{

    protected $currentPageInput = null;
    protected $numItemsPerPageInput = null;
    
    public function __construct($currentPageInput, $numItemsPerPageInput)
    {
        $this->currentPageInput = ((int) $currentPageInput > 0) ? (int) $currentPageInput : 1;
        $this->numItemsPerPageInput = ((int) $numItemsPerPageInput > 0) ? (int) $numItemsPerPageInput : 10;
    }
    
    public function start($numItems)
    {
        $numItems = ((int) $numItems >= 0) ? (int) $numItems : 0;
        $this->calculate($numItems, $this->currentPageInput, $this->numItemsPerPageInput);
        return $this;
    }

}