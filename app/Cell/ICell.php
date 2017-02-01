<?php

namespace App\Cell;

interface ICell
{
    /**
     * @return int
     */
    public function getValue();

    /**
     * @param int $neighbourCount
     * @return int
     */
    public function nextState($neighbourCount);
}
