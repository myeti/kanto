<?php

namespace Ash\Item;

use Ash\Item;
use Ash\Pokemon;

class Potion extends Item
{

    /** @var int */
    protected $value = -50;

    /**
     * Effect
     */
    public function apply(Pokemon &$pokemon)
    {
        $pokemon->damage($this->value);
    }


} 