<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Board\NeighbourCounter;
use App\Board\Board;

class NeighbourCounterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetCountInCorners()
    {
        $matrix = [
            [1, 1, 0, 0, 0, 1],
            [1, 0, 1, 1, 0, 1],
            [1, 1, 0, 1, 1, 0],
            [0, 1, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 1]
        ];

        $board = new Board;
        $board->setMatrix($matrix);
        $cells = $board->getCellsFromMatrix();

        // Bal felso
        $counter = new NeighbourCounter($cells, 0, 0);
        $this->assertEquals(2, $counter->getCount());

        // Jobb felso
        $counter = new NeighbourCounter($cells, 0, 5);
        $this->assertEquals(1, $counter->getCount());

        // Bal also
        $counter = new NeighbourCounter($cells, 4, 0);
        $this->assertEquals(1, $counter->getCount());

        // Jobb also
        $counter = new NeighbourCounter($cells, 4, 5);
        $this->assertEquals(0, $counter->getCount());
    }

    /**
     * @covers NeighbourCounter::getCount()
     */
    public function testGetCountWithCellsDontHaveEightNeighbour()
    {
        $matrix = [
            [1, 1, 0, 0, 0, 1],
            [1, 0, 1, 1, 0, 1],
            [1, 1, 0, 1, 1, 0],
            [0, 1, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 1]
        ];

        $board = new Board;
        $board->setMatrix($matrix);
        $cells = $board->getCellsFromMatrix();

        $counter = new NeighbourCounter($cells, 0, 1);
        $this->assertEquals(3, $counter->getCount());

        $counter = new NeighbourCounter($cells, 0, 4);
        $this->assertEquals(3, $counter->getCount());

        $counter = new NeighbourCounter($cells, 1, 0);
        $this->assertEquals(4, $counter->getCount());
    }

    /**
     * @covers NeighbourCounter::getCount()
     */
    public function testGetCountWithCellsHaveEightNeighbours()
    {
        $matrix = [
            [1, 1, 0, 0, 0, 1],
            [1, 0, 1, 1, 0, 1],
            [1, 1, 0, 1, 1, 0],
            [0, 1, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 1]
        ];

        $board = new Board;
        $board->setMatrix($matrix);
        $cells = $board->getCellsFromMatrix();

        $counter = new NeighbourCounter($cells, 1, 1);
        $this->assertEquals(6, $counter->getCount());

        $counter = new NeighbourCounter($cells, 1, 2);
        $this->assertEquals(4, $counter->getCount());

        $counter = new NeighbourCounter($cells, 2, 2);
        $this->assertEquals(6, $counter->getCount());
    }
}
