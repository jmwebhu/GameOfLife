<?php

namespace App\Board;

use App\Cell\Cell;

class Board 
{
    /**
     * Ez hatarozza meg, hogy egy pozicio mellett hany szomszed erteket vizsgal
     * @var int
     */
    const NEIGHBOURS_COUNT = 8;

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

    /**
     * Visszaadja a board aktualis allapotabol a kovetkezo generaciot
     * @return int[]
     */
    public function nextGeneration()
    {
        $cells = $this->getCellsFromMatrix();
        $nextValues = [];

        foreach ($cells as $x => $array) {
            $nextValues[$x] = [];
            foreach ($array as $y => $cell) {
                /**
                 * @var App\Cell\Cell $cell
                 */
                $neighborCounter = new NeighbourCounter($cells, $x, $y);
                $nextValues[$x][$y] = $cell->nextState($neighborCounter->getCount());
            }
        }

        return $nextValues;
    }

    /**
     * @return [][]
     */
    public function getCellsFromMatrix()
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
