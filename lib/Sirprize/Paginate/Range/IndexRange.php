<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Paginate\Range;

use Sirprize\Paginate\Input\IndexInput;

/**
 * IndexRange.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
class IndexRange extends AbstractRange
{
    public function __construct(IndexInput $input)
    {
        $offset = ((int) $input->getOffset() >= 0) ? (int) $input->getOffset() : 0;
        $last = ((int) $input->getLast() >= $offset) ? (int) $input->getLast() : $offset + 9;
        $numItems = $last - $offset + 1;
        
        $this->offset = $offset;
        $this->last = $last;
        $this->numItems = $numItems;
    }
}