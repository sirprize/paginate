<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */
 
namespace Sirprize\Paginate\Input;

/**
 * AbstractInput.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
abstract class AbstractInput
{
    protected $defaultNumItems = 20;
    protected $maxItems = 100;

    public function setDefaultNumItems($defaultNumItems)
    {
        $this->defaultNumItems = ((int) $defaultNumItems >= 1) ? (int) $defaultNumItems : 20;
        return $this;
    }

    public function setMaxItems($maxItems)
    {
        $this->maxItems = ((int) $maxItems >= 1) ? (int) $maxItems : 100;
        return $this;
    }
}