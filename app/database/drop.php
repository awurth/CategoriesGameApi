<?php

use Illuminate\Database\Capsule\Manager;

$tables = [
    'activations',
    'persistences',
    'reminders',
    'role_users',
    'throttle',
    'roles',
    'access_token',
    'refresh_token',
    'user',
    'round_subject_user',
    'game_user',
    'game_subject',
    'round',
    'game',
    'subject'
];

Manager::schema()->disableForeignKeyConstraints();
foreach ($tables as $table) {
    Manager::schema()->dropIfExists($table);
}
