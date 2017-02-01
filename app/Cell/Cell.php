<?php

namespace App\Cell;

use App\Cell\State;
use App\Cell\StateFactory;

class Cell
{
    /**
     * @var App\Cell\State
     */
    protected $_state;

    /**
     * @var int
     */
    protected $_x;

    /**
     * @var int
     */
    protected $_y;

    /**
     * @var int
     */
    protected $_value;

    /**
     * @param int $_x 
     * @param int $_y 
     * @param int $_value 
     */
    public function __construct($_x, $_y, $_value)
    {
        $this->_x = $_x;
        $this->_y = $_y;
        $this->_value = $_value;
        $this->_state = StateFactory::createState($_value);
    }
}
