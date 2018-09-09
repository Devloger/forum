<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('login', 35);
            $table->string('password', 255);
            $table->datetime('register');
            $table->datetime('last_login');
            $table->date('birth');
            $table->text('about')->nullable();
            $table->boolean('sex')->nullable();
            $table->tinyInteger('group');
            $table->tinyInteger('rank');
            $table->string('avatar', 2000);
            $table->tinyinteger('status')->default(1);

            //$table->foreign('group')->references('id')->on('groups')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
