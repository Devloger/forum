<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Sections::class, function(\Faker\Generator $faker)
{
	return [
		'name' => $faker->realText(20),
		'description' => $faker->text(30),
		'category' => factory(\App\Models\Categories::class)->create()->id,
		'status' => 1,
		'url' => uniqid(true),
	];
});