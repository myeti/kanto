<?php

namespace Ash;

abstract class Attack
{

    /** @var int */
    protected $base = 1;

    /** @var array $stat => $value */
    protected $attacker = [];

    /** @var array $stat => $value */
    protected $defender = [];

    /** @var array $type => $value */
    protected $bonus = [];

    /** @var array $type => $value */
    protected $malus = [];


    /**
     * Calc attack value
     * @param Pokemon $attacker
     * @param Pokemon $defender
     * @return int
     */
    public function calc(Pokemon $attacker, Pokemon $defender)
    {
        $value = $this->base;
        $value = $this->attacker($value, $attacker);
        $value = $this->bonus($value, $defender);
        $value = $this->malus($value, $defender);
        $value = $this->defender($value, $defender);

        return (int)round($value);
    }


    /**
     * Calc attacker stats
     * @param float $value
     * @param Pokemon $attacker
     * @return float
     */
    protected function attacker($value, Pokemon $attacker)
    {
        foreach($this->attacker as $stat => $val) {
            $value += $attacker->{$stat} * $val;
        }

        return $value;
    }


    /**
     * Calc type based bonus
     * @param float $value
     * @param Pokemon $defender
     * @return float
     */
    protected function bonus($value, Pokemon $defender)
    {
        foreach($this->bonus as $type => $val) {
            if($defender->is($type)) {
                $value *= $val;
            }
        }

        return $value;
    }


    /**
     * Calc type based malus
     * @param float $value
     * @param Pokemon $defender
     * @return float
     */
    protected function malus($value, Pokemon $defender)
    {
        foreach($this->malus as $type => $val) {
            if($defender->is($type)) {
                $value /= $val;
            }
        }

        return $value;
    }


    /**
     * Calc defender stats
     * @param float $value
     * @param Pokemon $defender
     * @return float
     */
    protected function defender($value, Pokemon $defender)
    {
        foreach($this->defender as $stat => $val) {
            $value -= $defender->{$stat} * $val;
        }

        return $value;
    }

} 