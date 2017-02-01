<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\AbstractStateTestCase;
use App\Cell\StateLive;

class StateLiveTest extends AbstractStateTestCase
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
        $counters = $this->getCounters(['horizontal' => 1, 'vertical' => 1, 'diagonal' => 0]);
        $nextState = $state->nextState([], $counters);

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
        $counters = $this->getCounters(['horizontal' => 1, 'vertical' => 1, 'diagonal' => 1]);
        $nextState = $state->nextState([], $counters);

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
        $counters = $this->getCounters(['horizontal' => 1, 'vertical' => 0, 'diagonal' => 0]);
        $nextState = $state->nextState([], $counters);

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
        $counters = $this->getCounters(['horizontal' => 2, 'vertical' => 1, 'diagonal' => 1]);
        $nextState = $state->nextState([], $counters);

        $this->assertEquals(0, $nextState);
    }
}
