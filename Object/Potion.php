<?php

namespace Kanto\Item;

use Kanto\Item;
use Kanto\Pokemon;

class Potion extends Item
{

    /** @var int */
    protected $value = -50;

    /**
     * Effect
     */
    public function effect(Pokemon &$pokemon)
    {
        $pokemon->damage($this->value);
    }


} 