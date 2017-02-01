<?php

namespace App\Cell;

use App\Cell\State;

class StateDead extends State
{
    /**
     * @param int $neighbourCount
     * @return int
     */
    public function nextState($neighbourCount)
    {
        if ($neighbourCount == 3) {
            return 1;
        } 

        return 0;
    }
}

