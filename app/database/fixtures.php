<?php

use App\Game\Model\Subject;

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
