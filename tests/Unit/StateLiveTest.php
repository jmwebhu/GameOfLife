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
        $counters = $this->getCounters(['horizontal' => 1, 'vertical' => 1, 'diagonal' => 0], [], 1, 1);
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

    protected function getCounters(array $counts)
    {
        $mockHorizontal = $this->getMockBuilder('App\Board\NeighbourCounterHorizontal')
            ->setConstructorArgs([[], 1, 1])
            ->setMethods(['getCount'])
            ->getMock();

        $mockHorizontal->expects($this->any())
            ->method('getCount')
            ->will($this->returnValue($counts['horizontal']));

        $mockVertical = $this->getMockBuilder('App\Board\NeighbourCounterVertical')
            ->setConstructorArgs([[], 1, 1])
            ->setMethods(['getCount'])
            ->getMock();

        $mockVertical->expects($this->any())
            ->method('getCount')
            ->will($this->returnValue($counts['vertical']));

        $mockDiagonal = $this->getMockBuilder('App\Board\NeighbourCounterDiagonal')
            ->setConstructorArgs([[], 1, 1])
            ->setMethods(['getCount'])
            ->getMock();

        $mockDiagonal->expects($this->any())
            ->method('getCount')
            ->will($this->returnValue($counts['diagonal']));

        return [$mockVertical, $mockHorizontal, $mockDiagonal];
    }
}
