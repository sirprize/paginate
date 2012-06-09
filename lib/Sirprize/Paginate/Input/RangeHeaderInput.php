<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
 
namespace Sirprize\Paginate\Input;

/**
 * RangeHeaderInput.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
class RangeHeaderInput extends IndexInput
{
    protected $isValid = false;

    public function __construct($rangeHeader)
    {
        if(preg_match('/^\w+=(\d*)-(\d*)$/', $rangeHeader, $matches))
        {
            $this->offset = (int) $matches[1];
            $this->last = (int) $matches[2];
            $this->isValid = true;
        }
    }
    
    public function isValid()
    {
        return $this->isValid;
    }
}