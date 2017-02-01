<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Cell\StateLive;

class StateLiveTest extends TestCase
{
    /**
     * Szabalyok:
     *  1. Tovabb el, ha 2 vagy 3 szomszedja van
     *  2. Meghal, ha 1 elo szomszedja van, VAGY 3 -nal tobb elo szomszedja van
     */

    /**
     * Tovabb el az 1. szabaly alapjan
     * @covers StateLive::nextState()
     */
    public function testLiveStateStayingAliveByTwoNeighbours()
    {
        $state = new StateLive(1);

        // Osszesen 2 szomszedja van
        $nextState = $state->nextState(2);
        $this->assertEquals(1, $nextState);
    }

    /**
     * Tovabb el az 1. szabaly alapjan
     * @covers StateLive::nextState()
     */
    public function testLiveStateStayingAliveByThreeNeighbours()
    {
        $state = new StateLive(1);

        // Osszesen 3 szomszedja van
        $nextState = $state->nextState(3);
        $this->assertEquals(1, $nextState);
    }

    /**
     * Elpusztul a 2. szabaly alapjan
     * @covers StateLive::nextState()
     */
    public function testLiveStateDieByOneNeighbours()
    {
        $state = new StateLive(1);

        // Osszesen 1 szomszedja van
        $nextState = $state->nextState(1);
        $this->assertEquals(0, $nextState);
    }

    /**
     * Elpusztul a 2. szabaly alapjan
     * @covers StateLive::nextState()
     */
    public function testLiveStateDieByTooMuchNeighbours()
    {
        $state = new StateLive(1);

        // Osszesen 4 szomszedja van
        $nextState = $state->nextState([], 4);
        $this->assertEquals(0, $nextState);
    }
}
