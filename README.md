# Welcome to Kanto !

Ready to be the best trainer ?

```php
$ash = new Trainer('Ash');
```
Here is your first pokemon, take care of him !
And take this `Potion`, it might be useful.

```php
$ash->capture(new Pikachu(5));
$ash->take(new Potion);
```

Oh ! A wild Rattata appeared !
Go Pikachu !

```php
$rattata = new Rattata(2);

$pikachu = $ash->go('Pikachu');
$pikachu->attack('ThunderShock', $rattata);
```

Beware, he counter-attacks !

```php
$rattata->attack('Tackle', $pikachu);
```

I'll heal you with this `Potion`, then finish him !

```php
$ash->give('Potion', $pikachu);
$pikachu->attack('ThunderShock', $rattata);
```

Yes, you won ! Time to move on.

```php
if($xp = $rattata->ko()) {
    $pikachu->gain($xp);
}
```

Look, a stone on the ground !
We can use it to make you evolve.

```php
$ash->take(new ThunderStone);
$raichu = $ash->give('ThunderStone', $pikachu);
```

# \o/