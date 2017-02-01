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

    public function nextGeneration()
    {
        $cells = $this->getCellsFromMatrix();
        foreach ($cells as $x => $array) {
            foreach ($array as $y => $cell) {
                /**
                 * @var App\Cell\Cell $cell
                 */
                $nextState = $cell->nextState($cells);
            }
        }
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

    /**
     * Visszaadja a megadott pozicio mellett levo 8 erteket
     * Vizszintesen, fuggolegesen, atlosan
     * @param int $x 
     * @param int $y 
     * @return void
     */
    public function getNeighboursOf($x, $y)
    {
        $half = intval(self::NEIGHBOURS_COUNT / 2);
    }
}
