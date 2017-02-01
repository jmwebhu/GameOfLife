<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class AbstractStateTestCase extends TestCase
{
     /**
      * @param array $counts 
      * @return void
      */
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

