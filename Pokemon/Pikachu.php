<?php

namespace Ash\Pokemon;

use Ash\Pokemon;
use Ash\Type;

class Pikachu extends Pokemon
{

    /** @var int */
    public $hp = 100;

    /** @var int */
    protected $type = Type::ELECTRIC;

    /** @var array */
    protected $evo = ['ThunderStone' => 'Raichu'];

    /** @var array */
    protected $learning = [
        1   => ['ThunderShock', 'Growl'],
        9   => 'TailWhip',
        16  => 'ThunderWave',
        26  => 'QuickAttack',
        33  => 'Agility',
        43  => 'Thunder',
    ];

    /** @var string */
    protected $roar = 'Pika pika !';

} 