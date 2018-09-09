<?php

namespace Tests\Feature;

use App\Models\Posts;
use App\Models\Users;
use App\Traits\recCountTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class postLikeTest extends TestCase {

	use DatabaseTransactions;

	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function test()
	{

		$post = factory(Posts::class)->create();
		$liker = factory(Users::class)->create();

		$response = $this->actingAs($liker)
			->post(route('temat.post.like'), [
				'_token' => csrf_token(),
				'post'   => $post->id,
			]);

		$response->assertStatus(302)->assertSessionHas('Done');
	}
}
