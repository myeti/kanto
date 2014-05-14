# Welcome to Kanto !

```php
<?php

use Kanto\Trainer;
use Kanto\Item\Potion;
use Kanto\Pokemon\Pikachu;
use Kanto\Pokemon\Rattata;

/**
 * Hello You,
 * ready to be the best trainer ?
 */
$ash = new Trainer('Ash');

/**
 * Here is your first pokemon,
 * take care of him !
 * Oh, and take this potion.
 */
$ash->capture(new Pikachu(5));
$ash->take(new Potion);

/**
 * A wild Rattata appeared !
 */
$rattata = new Rattata(2);

/**
 * Pikachu, go !
 */
$pikachu = $ash->go('Pikachu');
$pikachu->attack('ThunderShock', $rattata);

/**
 * Yeah, you won !
 */
if($exp = $rattata->ko()) {
    $pikachu->gain($exp);
}

```