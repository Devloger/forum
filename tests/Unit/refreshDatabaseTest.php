<?php

namespace Tests\Unit;

use App\Models\Users;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class refreshDatabaseTest extends TestCase
{
	
	use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRefreshDatabase()
    {
    	factory(Users::class)->create();
        $this->assertTrue(true);
    }
}
