<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Topics::class, function(\Faker\Generator $faker)
{
	return [
		'name' => $faker->sentence(),
		'section' => factory(\App\Models\Sections::class)->create()->id,
		'status' => 1,
		'url' => $faker->slug(),
		'pin' => 0,
		'views' => 0,
		'date' => \Carbon\Carbon::NOW(),
	];
});