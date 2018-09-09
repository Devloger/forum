<?php

namespace Tests\Feature\topics;

use App\Models\Sections;
use App\Models\Users;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class topic_createTest extends TestCase {

	use DatabaseTransactions;

	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function test()
	{
		$section = factory(Sections::class)->create();
		$poster = factory(Users::class)->create();

		$response = $this->actingAs($poster)->post(route('sekcja.topic.store', $section), [
			'_token'  => csrf_token(),
			'name'    => 'testqqqtest',
			'content' => 'thisIStestContent',
		]);

		$response->assertStatus(302)->assertSessionHas('Done');
	}
}
