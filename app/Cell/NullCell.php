<?php

namespace App\Cell;

use App\Cell\State;
use App\Cell\StateFactory;
use App\Cell\ICell;

class NullCell implements ICell
{
    /**
     * @return int
     */
    public function getValue() 
    {
        return 0; 
    }

    public function nextState()
    {
        return 0;
    }
}
