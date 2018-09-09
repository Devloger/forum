<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Users::class, function(\Faker\Generator $faker)
{
	return [
		'login' => $faker->userName(),
		'email' => $faker->email(),
		'password' => bcrypt($faker->password()),
		'group' => 1,
		'rank' => 1,
	];
});