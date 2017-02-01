<?php

namespace App\Board;

abstract class NeighbourCounter
{
    /**
     * @var [][]
     */
    protected $_cells;
    
    protected $_x;

    protected $_y;

    public function __construct(array $_cells, $_x, $_y)
    {
        $this->_cells = $_cells;
        $this->_x = $_x;
        $this->_y = $_y;
    }

    /**
     * @return int
     */
    abstract public function getCount();
}
