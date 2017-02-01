<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Cell\StateLive;

class StateLiveTest extends TestCase
{
    public function testNextState()
    {
        // [1][1] pozicioju elem szomszedjai
        /* $counterHorizontal = new NeighbourCounterHorizontal($cells, 1, 1); */
        $counters = $this->getCounters(['horizontal' => 1, 'vertical' => 1, 'diagonal' => 1], [], 1, 1);
        $state = new StateLive(1);
        $nextState = $state->nextState([], $counters);

    }

    protected function getCounters(array $counts, array $cells, $x, $y)
    {
        $mockHorizontal = $this->getMockBuilder('App\Board\NeighbourCounterHorizontal')
            ->setConstructorArgs([$cells, $x, $y])
            ->setMethods(['getCount'])
            ->getMock();

        $mockHorizontal->expects($this->any())
            ->method('getCount')
            ->will($this->returnValue($counts['horizontal']));

        $mockVertical = $this->getMockBuilder('App\Board\NeighbourCounterVertical')
            ->setConstructorArgs([$cells, $x, $y])
            ->setMethods(['getCount'])
            ->getMock();

        $mockVertical->expects($this->any())
            ->method('getCount')
            ->will($this->returnValue($counts['vertical']));

        $mockDiagonal = $this->getMockBuilder('App\Board\NeighbourCounterDiagonal')
            ->setConstructorArgs([$cells, $x, $y])
            ->setMethods(['getCount'])
            ->getMock();

        $mockDiagonal->expects($this->any())
            ->method('getCount')
            ->will($this->returnValue($counts['diagonal']));

        return [$mockVertical, $mockHorizontal, $mockDiagonal];
    }
}
