<?php

namespace Kanto;

use Kanto\Item\Stone;

abstract class Pokemon
{

    /** @var int */
    public $level = 1;

    /** @var int */
    public $exp = 0;

    /** @var int */
    public $type;

    /** @var int */
    public $hp = 10;

    /** @var int */
    public $atk = 10;

    /** @var int */
    public $def = 10;

    /** @var int */
    public $spd = 10;

    /** @var int */
    public $spe = 10;

    /** @var int */
    protected $maxHp = 10;

    /** @var array */
    protected $evo = [];

    /** @var array */
    protected $learning = [
        1   => ['ThunderShock', 'Growl'],
        9   => 'TailWhip',
        16  => 'ThunderWave',
        26  => 'QuickAttack',
        33  => 'Agility',
        43  => 'Thunder',
    ];

    /** @var Attack[] */
    protected $skills = [];

    /** @var string */
    protected $roar;


    /**
     * Spawn pokemon
     * @param $level
     */
    public function __construct($level)
    {
        // set max hp
        $this->maxHp = $this->hp;

        // set level
        $exp = pow(20, $level);
        $this->gain($exp);

        // generate skills
        $this->loadSkills();
    }


    /**
     * Generate skill liste
     */
    protected function loadSkills()
    {
        foreach($this->learning as $lvl => $skill) {
            if($this->level >= $lvl) {
                if(is_array($skill)) {
                    foreach($skill as $s) {
                        $this->learn($s);
                    }
                }
                else {
                    $this->learn($skill);
                }
            }
        }
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
     * Learn new attack
     * @param string $skill
     */
    public function learn($skill)
    {
        $class = '\Kanto\Attack\\' . $skill;
        if(!class_exists($class)) {
            $class = '\Kanto\attack\Fallback';
        }
        $this->skills[$skill] = new $class();
    }


    /**
     * Get exp if ko
     * @return int exp
     */
    public function ko()
    {
        if($this->hp <= 0) {
            return rand(5, 20) * ($this->level * 2);
        }

        return 0;
    }


    /**
     * Gain exp & load new skills
     * @param int $exp
     * @return float
     */
    public function gain($exp)
    {
        $this->exp += $exp;
        $this->level = log($this->exp, 20);

        $this->loadSkills();

        return $this->level;
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
     * take damage from attack
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
     * Try evolving
     * @param Stone $stone
     * @return bool|Pokemon
     */
    public function evolve(Stone $stone = null)
    {
        // find possible evolution
        foreach($this->evo as $type => $evo) {

            // stone condition or level condition
            if(($stone and $type === $stone->name()) xor (!$stone and is_int($type) and $this->level >= $type)) {

                // create pokemon
                return new $evo($this->level);
            }

        }

        return false;
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