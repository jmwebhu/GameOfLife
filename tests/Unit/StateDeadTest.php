<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\AbstractStateTestCase;
use App\Cell\StateDead;

class StateDeadTest extends AbstractStateTestCase
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
        $counters = $this->getCounters(['horizontal' => 1, 'vertical' => 1, 'diagonal' => 0]);
        $nextState = $state->nextState([], $counters);

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
        $counters = $this->getCounters(['horizontal' => 2, 'vertical' => 2, 'diagonal' => 0]);
        $nextState = $state->nextState([], $counters);

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
        $counters = $this->getCounters(['horizontal' => 2, 'vertical' => 0, 'diagonal' => 1]);
        $nextState = $state->nextState([], $counters);

        $this->assertEquals(1, $nextState);
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

