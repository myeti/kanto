<?php

namespace Kanto;

use Kanto\Nope\TooManyPokemon;

class Trainer
{

    /** @var string */
    public $name;

    /** @var Item[] */
    protected $bag = [];

    /** @var Pokemon[] */
    protected $pokemons = [];


    /**
     * Set new player
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }


    /**
     * Add captured pokemon
     * @param Pokemon $pokemon
     * @return int
     * @throws Nope\TooManyPokemon
     */
    public function capture(Pokemon $pokemon)
    {
        if(count($this->pokemons >= 6)) {
            throw new TooManyPokemon;
        }

        return array_push($this->pokemons, $pokemon);
    }


    /**
     * Release captured pokemon
     * @param string $name
     * @return int
     */
    public function release($name)
    {
        foreach($this->pokemons as $i => $pokemon) {
            if($pokemon->name() === $name) {
                unset($this->pokemons[$i]);
                break;
            }
        }
    }


    /**
     * Find pokemon
     * @param $name
     * @return Pokemon|bool
     */
    public function &go($name)
    {
        foreach($this->pokemons as &$pokemon) {
            if($pokemon->name() === $name) {
                return $pokemon;
            }
        }

        return false;
    }


    /**
     * Set item
     * @param Item $object
     * @param int $nb
     */
    public function take(Item $object, $nb = 1)
    {
        $name = $object->name();

        // create space
        if(!isset($this->bag[$name])) {
            $this->bag[$name] = [];
        }

        // push objects
        for($i = 0; $i < $nb; $i++) {
            array_push($this->bag[$name], clone $object);
        }
    }


    /**
     * Get item
     * @param $name
     * @return bool|Item
     */
    public function get($name)
    {
        // has no object
        if(!isset($this->bag[$name])) {
            return false;
        }

        return array_pop($this->bag[$name]);
    }

} 