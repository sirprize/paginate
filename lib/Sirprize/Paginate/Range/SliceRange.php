<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Paginate\Range;

use Sirprize\Paginate\Input\SliceInput;

/**
 * SliceRange.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
class SliceRange extends AbstractRange
{
    public function __construct(SliceInput $input)
    {
        $offset = ((int) $input->getOffset() >= 0) ? (int) $input->getOffset() : 0;
        $numItems = ((int) $input->getNumItems() > 0) ? (int) $input->getNumItems() : 10;
        $last = $offset + $numItems - 1;
        
        $this->offset = $offset;
        $this->last = $last;
        $this->numItems = $numItems;
    }
}