<?php

namespace App;

use App\Cell\Cell;

class Board 
{
    /**
     * @var int
     */
    protected $_width;

    /**
     * @var int
     */
    protected $_height;

    /**
     * @var int[][]
     */
    protected $_matrix;

    public function getWidth() { return $this->_width; }
    public function getHeight() { return $this->_height; }
    public function getMatrix() { return $this->_matrix; }

    /**
     * @param array $matrix 
     * @return void
     */
    public function setMatrix(array $matrix) 
    { 
        $this->_matrix = $matrix; 
        $this->_width = count($matrix);
        $this->_height = count($matrix[0]);
    }

    public function nextGeneration()
    {
        $cells = $this->getCellsFromMatrix();
        var_dump($cells);
    }

    /**
     * @return [][]
     */
    protected function getCellsFromMatrix()
    {
        $cells = [];
        foreach ($this->_matrix as $x => $array) {
            $cells[$x] = [];
            foreach ($array as $y => $value) {
                $cells[$x][$y] = new Cell($x, $y, $value);
            }
        }

        return $cells;
    }
}
