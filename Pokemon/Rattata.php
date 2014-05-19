<?php

namespace Kanto\Pokemon;

use Kanto\Pokemon;

class Rattata extends Pokemon
{

    /** @var string */
    protected $roar = 'Rrraaaattata !';

    /** @var array */
    protected $stats = [
        'xp'  => [10, 1],
        'hp'  => [4, 1],
        'atk' => [10, 1],
        'def' => [10, 1],
        'spd' => [10, 1],
        'spe' => [10, 1],
    ];

    /** @var array */
    protected $events = [
        'Level:1'           => ['Learn:Tackle', 'Learn:TailWhip'],
        'Level:7'           => 'Learn:QuickAttack',
        'Level:14'          => 'Learn:HyperFang',
        'Level:20'          => 'Evolve:Raticate',
        'Level:23'          => 'Learn:FocusEnergy',
        'Level:34'          => 'Learn:SuperFang'
    ];

} 