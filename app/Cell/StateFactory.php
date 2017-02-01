<?php

namespace App\Cell;

use App\Cell\StateLive;
use App\Cell\StateDead;

class StateFactory
{
    /**
     * @param int $x 
     * @param int $y 
     * @param int $value 
     * @return App\Cell\State
     */
    public static function createState($value)
    {
        if ($value == 1) {
            return new StateLive($value);
        }

        return new StateDead($value);
    }
}

