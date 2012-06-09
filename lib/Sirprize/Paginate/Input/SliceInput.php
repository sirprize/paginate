<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
 
namespace Sirprize\Paginate\Input;

/**
 * SliceInput.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
class SliceInput extends AbstractInput
{
    protected $offset = null;
    protected $numItems = null;

    public function __construct($offset = null, $numItems = null)
    {
        $this->offset = (int) $offset;
        $this->numItems = (int) $numItems;
    }
    
    public function getOffset()
    {
        return ($this->offset !== null && $this->offset >= 0) ? $this->offset : 0;
    }
    
    public function getNumItems()
    {
        $numItems = ($this->numItems >= 1) ? $this->numItems : $this->defaultNumItems;
        return ($numItems <= $this->maxItems) ? $numItems : $this->maxItems;
    }
}