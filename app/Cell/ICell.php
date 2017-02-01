<?php

namespace App\Cell;

interface ICell
{
    /**
     * @return int
     */
    public function getValue();

    /**
     * @return int
     */
    public function nextState();
}
