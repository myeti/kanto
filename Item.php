<?php

namespace Kanto;

abstract class Item
{

    /**
     * Get object name
     * @return string
     */
    public function name()
    {
        $ns = get_called_class();
        $ns = explode('\\', $ns);
        return end($ns);
    }

    /**
     * Effect
     */
    public function apply(Pokemon &$pokemon)
    {

    }

} 