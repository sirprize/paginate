<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
 
namespace Sirprize\Paginate\Range;

use Sirprize\Paginate\Input\PageInput;
use Sirprize\Paginate\Input\RangeHeaderInput;

/**
 * RangeTypeDetector.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
class RangeTypeDetector
{
    protected $pageInput = null;
    protected $rangeHeaderInput = null;
    protected $startFromCurrentPage = true;
    protected $range = null;

    public function __construct($page = null, $perPage = null, $rangeHeader = null)
    {
        $this->pageInput = new PageInput($page, $perPage);
        $this->rangeHeaderInput = new RangeHeaderInput($rangeHeader);
        
        if($this->rangeHeaderInput->isValid())
        {
            $this->startFromCurrentPage = false;
        }

        if($page !== null)
        {
            $this->startFromCurrentPage = true;
        }
    }

    public function setDefaultNumItems($defaultNumItems)
    {
        $this->pageInput->setDefaultNumItems($defaultNumItems);
        $this->rangeHeaderInput->setDefaultNumItems($defaultNumItems);
        return $this;
    }

    public function setMaxItems($maxItems)
    {
        $this->pageInput->setMaxItems($maxItems);
        $this->rangeHeaderInput->setMaxItems($maxItems);
        return $this;
    }

    public function getRange()
    {
        if($this->range)
        {
            return $this->range;
        }
        
        if($this->startFromCurrentPage)
        {
            $this->range = new PageRange($this->pageInput);
        }
        else {
            $this->range = new IndexRange($this->rangeHeaderInput);
        }

        return $this->range;
    }
}