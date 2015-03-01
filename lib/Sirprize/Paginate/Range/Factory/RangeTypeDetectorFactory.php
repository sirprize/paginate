<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
 
namespace Sirprize\Paginate\Range\Factory;

use Sirprize\Paginate\Range\RangeTypeDetector;

/**
 * RangeTypeDetectorFactory.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
class RangeTypeDetectorFactory
{
    public function getInstance($page = null, $perPage = null, $rangeHeader = null)
    {
        return new RangeTypeDetector($page, $perPage, $rangeHeader);
    }
}