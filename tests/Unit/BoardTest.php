<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Board;

class BoardTest extends TestCase
{
    /**
     * @var App\Board
     */
    protected $_board;

    /**
     * @covers Board::setMatrix()
     */
    public function testSetMatrix()
    {
        $board = new Board;
        $matrix = [
            [0, 1, 0],
            [1, 1, 0],
            [0, 0, 0]
        ];

        $board->setMatrix($matrix);

        $this->assertEquals(3, $board->getWidth());
        $this->assertEquals(3, $board->getHeight());
        $this->assertEquals($matrix, $board->getMatrix());
    }
}
