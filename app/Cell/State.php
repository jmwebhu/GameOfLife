<?php

namespace App\Cell;

use App\Cell;

abstract class State
{
    /**
     * @var int
     */
    protected $_value;

    /**
     * @param int $_value 
     */
    public function __construct($_value)
    {
        $this->_value = $_value;
    }
}
