<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
 
namespace Sirprize\Paginate\Input;

/**
 * PageInput.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
class PageInput extends AbstractInput
{
    protected $page = null;
    protected $perPage = null;

    public function __construct($page = null, $perPage = null)
    {
        $this->page = (int) $page;
        $this->perPage = (int) $perPage;
    }
    
    public function getPage()
    {
        return ($this->page >= 1) ? $this->page : 1;
    }
    
    public function getPerPage()
    {
        $perPage = ($this->perPage >= 1) ? $this->perPage : $this->defaultNumItems;
        return ($perPage <= $this->maxItems) ? $perPage : $this->maxItems;
    }
}