<?php

namespace App\Cell;

use App\Cell\State;

class StateLive extends State
{
    /**
     * @param int $neighbourCount
     * @return int
     */
    public function nextState($neighbourCount)
    {
        if (in_array($neighbourCount, range(2, 3))) {
            return 1;
        }
        
        return 0;
    }
}
