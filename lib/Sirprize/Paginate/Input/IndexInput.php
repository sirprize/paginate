<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
 
namespace Sirprize\Paginate\Input;

/**
 * IndexInput.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
class IndexInput extends AbstractInput
{
    protected $offset = null;
    protected $last = null;

    public function __construct($offset, $last)
    {
        $this->offset = (int) $offset;
        $this->last = (int) $last;
    }
    
    public function getOffset()
    {
        return ($this->offset !== null && $this->offset >= 0) ? $this->offset : 0;
    }
    
    public function getLast()
    {
        $last = ($this->last !== null && $this->last >= 0 && $this->last >= $this->getOffset()) ? $this->last : $this->getOffset() + $this->defaultNumItems - 1;
        return (($last - $this->getOffset() + 1) > $this->maxItems) ? $this->getOffset() + $this->maxItems - 1 : $last;
    }
}