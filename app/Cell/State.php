<?php

namespace App\Cell;

use App\Cell\Cell;

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

    /**
     * @param int $neighbourCount
     * @return int  
     */
    abstract public function nextState($neighbourCount); 
}
