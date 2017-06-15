<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
           // $table->integer('question_id')->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('telephone')->unique();
            $table->string('sex');
            $table->date('date_of_birth');
            $table->string('avatar')->default('default.jpg');
            $table->rememberToken();
            $table->timestamps();

        //     $table->foreign('question_id')
        //     ->references('id')
        //     ->on('question')
        //     ->onDelete('cascade');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
