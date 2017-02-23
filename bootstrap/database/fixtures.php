<?php

use App\Model\Subject;
use App\Model\Game;

$subjectsNames = [
    'Prénom',
    'Animal',
    'Anatomie',
    'Objet',
    'Célébrité',
    'Aliment'
];

foreach ($subjectsNames as $subjectName) {
    $subject = new Subject(['name' => $subjectName]);
    $subject->save();
}

$game = new Game();
$game->save();
$game->subjects()->attach(Subject::all());