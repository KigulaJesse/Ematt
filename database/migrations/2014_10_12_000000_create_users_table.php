<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name');
            $table->string('last name')->nullable();
            $table->string('contact');
            $table->string('user_type')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('address')->nullable();
            $table->string('payment_type')->nullable();
            $table->integer('total_rating')->nullable();
            $table->integer('no_ppl_that_rated')->nullable();
            $table->integer('average_rating')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('address')
                  ->references('id')
                  ->on('districts');
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
