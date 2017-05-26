<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Followers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('follower');
            $table->string('followed')->unique();
            $table->timestamps();
        });
        Schema::table('followers', function($table){
            $table->foreign('follower')->references('username')->on('users')->onDelete('cascade');
            $table->foreign('followed')->references('username')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('followers');
        Schema::dropForeign(['follower']);
        Schema::dropForeign(['followed']);
    }
}
