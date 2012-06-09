<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Paginate\Range;

use Sirprize\Paginate\Input\PageInput;

/**
 * PageRange.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
class PageRange extends AbstractRange
{
    protected $currentPage = null;
    
    public function __construct(PageInput $input)
    {
        $currentPage = ((int) $input->getPage() > 0) ? (int) $input->getPage() : 1;
        $numItemsPerPage = ((int) $input->getPerPage() > 0) ? (int) $input->getPerPage() : 10;
        $offset = ($currentPage - 1) * $numItemsPerPage;
        $last = $offset + $numItemsPerPage - 1;
        
        $this->offset = $offset;
        $this->last = $last;
        $this->numItems = $numItemsPerPage;
        $this->currentPage = $currentPage;
    }
    
    public function getCurrentPage()
    {
        return $this->currentPage;
    }
}