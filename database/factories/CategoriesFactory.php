<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Categories::class, function(\Faker\Generator $faker)
{
	return [
		'name' => $faker->realText(25),
		'description' => $faker->sentence(),
	];

});