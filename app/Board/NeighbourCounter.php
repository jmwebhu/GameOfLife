<?php

namespace App\Board;

use App\Cell\NullCell;

 class NeighbourCounter
{
    /**
     * @var [][]
     */
    protected $_cells;
    
    /**
     * @var int
     */
    protected $_x;

    /**
     * @var int
     */
    protected $_y;

    /**
     * @param array $_cells 
     * @param int $_x 
     * @param int $_y 
     */
    public function __construct(array $_cells, $_x, $_y)
    {
        $this->_cells = $_cells;
        $this->_x = $_x;
        $this->_y = $_y;
    }

    /**
     * @return int
     */
    public function getCount() 
    {
        $neighbours = [];

        for ($x = $this->_x - 1; $x <= $this->_x + 1; $x++) {
            for ($y = $this->_y - 1; $y <= $this->_y + 1; $y++) {
                
                if ($x == $this->_x && $y == $this->_y)
                    continue;

                $neighbours[] = array_get($this->_cells, $x . '.' . $y, new NullCell)->getValue();
            }
        }

        return array_sum($neighbours);
    }
}
