<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Paginate\Range;

/**
 * AbstractRange.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
abstract class AbstractRange implements RangeInterface
{
    protected $numItems = null;
    protected $offset = null; // starts at 0
    protected $last = null;
    protected $totalItems = 0;
    
    public function setTotalItems($totalItems)
    {
        $this->totalItems = ((int) $totalItems >= 0) ? (int) $totalItems : 0;
        return $this;
    }
    
    public function getTotalItems() { return $this->totalItems; }
    public function getNumItems() { return $this->numItems; }
    public function getOffset() { return $this->offset; }
    public function getLast() { return $this->last; }
}