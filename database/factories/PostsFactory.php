<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Posts::class, function(\Faker\Generator $faker) {

	return [
		'author' => factory(\App\Models\Users::class)->create()->id,
		'date' => \Carbon\Carbon::NOW(),
		'content' => $faker->realText(395),
		'topic' => factory(\App\Models\Topics::class)->create()->id,
		'first' => 1,
	];
});