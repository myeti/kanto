<?php

namespace Kanto\Pokemon;

use Kanto\Pokemon;
use Kanto\Type;

class Pikachu extends Pokemon
{

    /** @var int */
    protected $type = Type::ELECTRIC;

    /** @var string */
    protected $roar = 'Pika pika !';

    /** @var array */
    protected $stats = [
        'xp'  => [10, 1],
        'hp'  => [10, 1],
        'atk' => [10, 1],
        'def' => [10, 1],
        'spd' => [10, 1],
        'spe' => [10, 1],
    ];

    /** @var array */
    protected $events = [
        'Item:ThunderStone' => 'Evolve:Raichu',
        'Level:1'           => ['Learn:ThunderShock', 'Learn:Growl'],
        'Level:9'           => 'Learn:TailWhip',
        'Level:16'          => 'Learn:ThunderWave',
        'Level:26'          => 'Learn:QuickAttack',
        'Level:33'          => 'Learn:Agility',
        'Level:43'          => 'Learn:Thunder',
    ];

} 