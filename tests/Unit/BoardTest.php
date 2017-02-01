<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Board\Board;

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
        $matrix = [
            [0, 1, 0],
            [1, 1, 0],
            [0, 0, 0]
        ];

        $this->createBoard($matrix);

        $this->assertEquals(3, $this->_board->getWidth());
        $this->assertEquals(3, $this->_board->getHeight());
        $this->assertEquals($matrix, $this->_board->getMatrix());
    }

    /**
     * @covers Board::getCellsFromMatrix()
     */
    public function testGetCellsFromMatrix()
    {
        $matrix = [
            [0, 1, 0],
            [1, 1, 0],
            [0, 0, 0]
        ];

        $this->createBoard($matrix);
        $cells = $this->invokeMethod($this->_board, 'getCellsFromMatrix', []);

        // Elso sor
        $this->assertEquals(0, $cells[0][0]->getValue());
        $this->assertEquals(1, $cells[0][1]->getValue());
        $this->assertEquals(0, $cells[0][2]->getValue());

        // Masodik sor
        $this->assertEquals(1, $cells[1][0]->getValue());
        $this->assertEquals(1, $cells[1][1]->getValue());
        $this->assertEquals(0, $cells[1][2]->getValue());

        // Harmadik sor
        $this->assertEquals(0, $cells[2][0]->getValue());
        $this->assertEquals(0, $cells[2][1]->getValue());
        $this->assertEquals(0, $cells[2][2]->getValue());
    }

    /**
     * @covers Board::nextGeneration()
     */
    public function testNextGenerationBlinker()
    {
        $matrix = [
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 1, 1, 1, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
        ];

        $expectedNextGeneration = [
            [0, 0, 0, 0, 0],
            [0, 0, 1, 0, 0],
            [0, 0, 1, 0, 0],
            [0, 0, 1, 0, 0],
            [0, 0, 0, 0, 0],
        ];

        $this->createBoard($matrix);
        $nextGeneration = $this->_board->nextGeneration();
        $this->assertEquals($expectedNextGeneration, $nextGeneration);
    }

    /**
     * @covers Board::nextGeneration()
     */
    public function testNextGenerationToad()
    {
        $matrix = [
            [0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0],
            [0, 0, 1, 1, 1, 0],
            [0, 1, 1, 1, 0, 0],
            [0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0],
        ];

        $expectedNextGeneration = [
            [0, 0, 0, 0, 0, 0],
            [0, 0, 0, 1, 0, 0],
            [0, 1, 0, 0, 1, 0],
            [0, 1, 0, 0, 1, 0],
            [0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0],
        ];

        $this->createBoard($matrix);
        $nextGeneration = $this->_board->nextGeneration();
        $this->assertEquals($expectedNextGeneration, $nextGeneration);
    }

    /**
     * @covers Board::nextGeneration()
     */
    public function testNextGenerationBlock()
    {
        $matrix = [
            [0, 0, 0, 0],
            [0, 1, 1, 0],
            [0, 1, 1, 0],
            [0, 0, 0, 0],
        ];

        $this->createBoard($matrix);
        $nextGeneration = $this->_board->nextGeneration();
        $this->assertEquals($matrix, $nextGeneration);
    }

    /**
     * @covers Board::nextGeneration()
     */
    public function testNextGenerationBeehive()
    {
        $matrix = [
            [0, 0, 0, 0, 0, 0],
            [0, 0, 1, 1, 0, 0],
            [0, 1, 0, 0, 1, 0],
            [0, 0, 1, 1, 0, 0],
            [0, 0, 0, 0, 0, 0],
        ];

        $this->createBoard($matrix);
        $nextGeneration = $this->_board->nextGeneration();
        $this->assertEquals($matrix, $nextGeneration);
    }

    protected function createBoard(array $matrix)
    {
        $board = new Board;
        $board->setMatrix($matrix);
        $this->_board = $board;
    }
}
