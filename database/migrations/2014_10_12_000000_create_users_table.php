<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 *
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('role',['admin','customer','vendor'])->default('customer');


            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->integer('postcode')->nullable();
            $table->string('street')->nullable();
            $table->string('num')->nullable();


            $table->string('scountry')->nullable();
            $table->string('scity')->nullable();
            $table->integer('spostcode')->nullable();
            $table->string('sstreet')->nullable();
            $table->string('snum')->nullable();

            $table->rememberToken();
            $table->timestamps();
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
