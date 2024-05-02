<?php

require "vendor/autoload.php";

class Demo {

    private $eleves = 
    [
        [
            'nom' => 'Marc',
            'age' => 14,
            'moyenne' => 12
        ],
        [
            'nom' => 'Serge',
            'age' => 16,
            'moyenne' => 06
        ],
        [
            'nom' => 'Louanne',
            'age' => 15,
            'moyenne' => 12
        ]
    ];

    public function bonEleves () {
        return array_filter($this->eleves, function ($eleve) {
            return $eleve['moyenne'] > 10;
        });
    }
}

$demo = new Demo();
var_dump($demo->bonEleves());