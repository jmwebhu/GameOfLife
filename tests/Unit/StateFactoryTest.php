<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Cell\StateFactory;
use App\Cell\StateLive;
use App\Cell\StateDead;

class StateFactoryTest extends TestCase
{
    /**
     * @covers StateFactory::createState()
     */
    public function testCreateState()
    {
        $state = StateFactory::createState(1);
        $this->assertTrue($state instanceof StateLive);

        $state = StateFactory::createState(2);
        $this->assertTrue($state instanceof StateDead);
    }
}
