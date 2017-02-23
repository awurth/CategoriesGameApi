<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;

Manager::schema()->create('subject', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name');
    $table->timestamps();
});

Manager::schema()->create('game', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('user_id')->unsigned();
    $table->timestamps();
    $table->foreign('user_id')->references('id')->on('user');
});

Manager::schema()->create('round', function (Blueprint $table) {
    $table->increments('id');
    $table->string('letter');
    $table->integer('game_id')->unsigned();
    $table->foreign('game_id')->references('id')->on('game');
});

Manager::schema()->create('game_subject', function (Blueprint $table) {
    $table->integer('game_id')->unsigned();
    $table->integer('subject_id')->unsigned();
    $table->foreign('game_id')->references('id')->on('game');
    $table->foreign('subject_id')->references('id')->on('subject');
});
