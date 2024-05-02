<?php

$maFonction = function ($nom) {
    return 'Salut' . $nom;
};

echo $maFonction(' Jean');


$eleves = [
    [
        'nom' => 'Marc',
        'age' => 14
    ],
    [
        'nom' => 'Serge',
        'age' => 16
    ],
    [
        'nom' => 'Louanne',
        'age' => 15
    ]
];

$key = 'age';
$sort = function ($eleve1, $eleve2) use($key) {
    return $eleve2[$key] - $eleve1[$key];
};

usort($eleves, $sort);
