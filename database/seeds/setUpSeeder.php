<?php

use Illuminate\Database\Seeder;

class setUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Posts::class, 10)->create();
    }
}
