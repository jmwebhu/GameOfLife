<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Cell\StateDead;

class StateDeadTest extends TestCase
{
    /**
     * Szabalyok:
     *  1. Egy halott sejt feleld, ha pontosan 3 szomszedja van
     */

    /**
     * Nem eled fel, mert tul keves szomszedja van
     * @covers StateDead::nextState()
     */
    public function testDeadStateStayingDeadByTooLittleNeighbours()
    {
        $state = new StateDead(0);

        // Osszesen 2 szomszedja van
        $nextState = $state->nextState(2);
        $this->assertEquals(0, $nextState);
    }

    /**
     * Nem eled fel, mert tul sok szomszedja van
     * @covers StateDead::nextState()
     */
    public function testDeadStateStayingDeadByTooMuchNeighbours()
    {
        $state = new StateDead(0);

        // Osszesen 4 szomszedja van
        $nextState = $state->nextState(4);
        $this->assertEquals(0, $nextState);
    }

    /**
     * Feleled fel, mert pontosan 3 szomszedja van
     * @covers StateDead::nextState()
     */
    public function testDeadStateComesToLife()
    {
        $state = new StateDead(0);

        // Osszesen 3 szomszedja van
        $nextState = $state->nextState(3);
        $this->assertEquals(1, $nextState);
    }
}

