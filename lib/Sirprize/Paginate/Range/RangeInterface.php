<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Paginate\Range;

/**
 * RangeInterface.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
interface RangeInterface
{
    public function setTotalItems($totalItems);
    public function getTotalItems();
    public function getOffset();
    public function getLast();
    public function getNumItems();
}