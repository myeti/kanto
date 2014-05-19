<?php

namespace Kanto;

abstract class Pokemon
{

    /** @var int */
    public $level = 1;

    /** @var int */
    public $type;

    /** @var int */
    public $xp;

    /** @var int */
    public $hp;

    /** @var int */
    public $maxHp;

    /** @var int */
    public $atk;

    /** @var int */
    public $def;

    /** @var int */
    public $spd;

    /** @var int */
    public $spe;

    /** @var string */
    protected $roar;

    /** @var Attack[] */
    protected $skills = [];

    /** @var array */
    protected $events = [];

    /** @var array */
    protected $stats = [
        'xp'  => [20, 2],
        'ko'  => [5, 2],
        'hp'  => [10, 1],
        'atk' => [10, 1],
        'def' => [10, 1],
        'spd' => [10, 1],
        'spe' => [10, 1],
    ];


    /**
     * Init pokemon
     * @param $level
     */
    public function __construct($level)
    {
        // set level
        $exp = $this->stats['xp'][0] + ($level * $this->stats['xp'][1]);
        $this->gain($exp);

        // init hp
        $this->hp = $this->maxHp;
    }


    /**
     * Check type
     * @param int $type
     * @return bool
     */
    public function is($type)
    {
        return ($type & $this->type) == $type;
    }


    /**
     * Gain xp
     * @param int $xp
     * @return bool|Pokemon
     */
    public function gain($xp)
    {
        // calculate level
        $this->xp += $xp;
        $this->level = $this->xp / $this->stats['xp'][0] / $this->stats['xp'][1];

        // calculate new stats
        $this->atk = $this->level * $this->stats['atk'][0] / $this->stats['atk'][1];
        $this->def = $this->level * $this->stats['def'][0] / $this->stats['def'][1];
        $this->spd = $this->level * $this->stats['spd'][0] / $this->stats['spd'][1];
        $this->spe = $this->level * $this->stats['spe'][0] / $this->stats['spe'][1];

        // level events
        for($i = 1; $i <= $this->level; $i++) {
            $data = $this->event('Level:' . $i);
            if($data instanceof Pokemon) {
                return $data;
            }
        }

        return true;
    }


    /**
     * Get exp if ko
     * @return int exp
     */
    public function ko()
    {
        if($this->hp <= 0) {
            return $this->level * $this->stats['ko'][0] / $this->stats['ko'][1];
        }

        return 0;
    }


    /**
     * Take item
     * @param Item $item
     * @return mixed
     */
    public function take(Item $item)
    {
        // apply effect
        $item->effect($this);

        // inner effect
        return $this->event('Item:' . $item->name());
    }


    /**
     * Attack on target
     * @param string $attack
     * @param Pokemon $target
     */
    public function attack($attack, Pokemon &$target)
    {
        if(isset($this->skills[$attack])) {
            $value = $this->skills[$attack]->calc($this, $target);
            $target->damage($value);
        }
    }


    /**
     * Take damage from attack
     * @param int $value
     */
    public function damage($value)
    {
        $this->hp -= $value;
        if($this->hp < 0) {
            $this->hp = 0;
        }
        elseif($this->hp > $this->maxHp) {
            $this->hp = $this->maxHp;
        }
    }


    /**
     * Learn new attack
     * @param string $skill
     */
    protected function learn($skill)
    {
        $class = '\Kanto\Attack\\' . $skill;
        if(!class_exists($class)) {
            $class = '\Kanto\Attack\Basic';
        }
        $this->skills[$skill] = new $class();
    }


    /**
     * Evolving
     * @param string $pokemon
     * @return Pokemon
     */
    protected function evolve($pokemon)
    {
        $class = '\kanto\Pokemon\\' . $pokemon;
        return $class();
    }


    /**
     * Trigger inner event
     * @param string $name
     * @return mixed
     */
    protected function event($name)
    {
        // error
        if(empty($this->events[$name])) {
            return null;
        }

        // init
        $data = null;

        // parse array
        if(is_array($this->events[$name])) {
            foreach($this->events[$name] as $action) {
                if(null !== $result = $this->call($action)) {
                    $data = $result;
                }
            }
        }
        else {
            $data = $this->call($this->events[$name]);
        }

        return $data;
    }


    /**
     * Call action
     * @param string $action
     * @return mixed
     */
    protected function call($action)
    {
        $args = explode(':', $action);
        $method = array_shift($args);
        if(method_exists($this, $method)) {
            return call_user_func_array([$this, $method], $args);
        }
    }


    /**
     * Get pokemon name
     * @return string
     */
    public function name()
    {
        $ns = get_called_class();
        $ns = explode('\\', $ns);
        return end($ns);
    }


    /**
     * Roar
     * @return string
     */
    public function __toString()
    {
        return $this->roar;
    }

} 