# Welcome to Kanto !

```php
<?php

use Ash\Trainer;
use Ash\Item\Potion;
use Ash\Pokemon\Pikachu;
use Ash\Pokemon\Rattata;

/**
 * Hello You,
 * ready to be the best trainer ?
 */
$you = new Trainer('You');

/**
 * Here is your first pokemon,
 * take care of him !
 * Oh, and take this potion.
 */
$you->capture(new Pikachu(5));
$you->take(new Potion);

/**
 * A wild Rattata appeared !
 */
$rattata = new Rattata(2);

/**
 * Pikachu, go !
 */
$pikachu = $you->go('Pikachu');
$pikachu->attack('ThunderShock', $rattata);

/**
 * Yeah, you won !
 */
if($exp = $rattata->ko()) {
    $pikachu->gain($exp);
}

```