<?php

namespace Ash\Pokemon;

use Ash\Pokemon;

class Rattata extends Pokemon
{

    /** @var int */
    public $hp = 4;

    /** @var array */
    protected $evo = [20 => 'Raticate'];

    /** @var array */
    protected $learning = [
        1   => ['Tackle', 'TailWhip'],
        7   => 'QuickAttack',
        14  => 'HyperFang',
        23  => 'FocusEnergy',
        34  => 'SuperFang',
    ];

    /** @var string */
    protected $roar = 'Rrraaaattata !';

} 