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
    $table->unsignedInteger('user_id');
    $table->timestamps();
    $table->foreign('user_id')->references('id')->on('user');
});

Manager::schema()->create('round', function (Blueprint $table) {
    $table->increments('id');
    $table->string('letter');
    $table->boolean('finished')->default(false);
    $table->timestamps();
    $table->unsignedInteger('game_id');
    $table->foreign('game_id')->references('id')->on('game');
});

Manager::schema()->create('game_subject', function (Blueprint $table) {
    $table->unsignedInteger('game_id');
    $table->unsignedInteger('subject_id');
    $table->primary(['game_id', 'subject_id']);
    $table->foreign('game_id')->references('id')->on('game');
    $table->foreign('subject_id')->references('id')->on('subject');
});

Manager::schema()->create('game_user', function (Blueprint $table) {
    $table->unsignedInteger('game_id');
    $table->unsignedInteger('user_id');
    $table->primary(['game_id', 'user_id']);
    $table->foreign('game_id')->references('id')->on('game');
    $table->foreign('user_id')->references('id')->on('user');
});

Manager::schema()->create('round_subject_user', function (Blueprint $table) {
    $table->increments('id');
    $table->unsignedInteger('round_id');
    $table->unsignedInteger('subject_id');
    $table->unsignedInteger('user_id');
    $table->unique(['round_id', 'subject_id', 'user_id']);
    $table->string('value');
    $table->foreign('round_id')->references('id')->on('round');
    $table->foreign('subject_id')->references('id')->on('subject');
    $table->foreign('user_id')->references('id')->on('user');
});
