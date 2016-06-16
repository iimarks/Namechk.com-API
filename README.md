# NameChk API  Unofficial :)
![NameChk](https://camo2.githubusercontent.com/4ebd759a50bd02a7d2e04fb144e55bfef943168e/68747470733a2f2f6e616d6563686b2e636f6d2f6173736574732f6c6f676f2d66756c6c2d30666561613632653137383262383332353939616238616337356665653264392e706e67)

PHP API for https://namechk.com - 2016.

-----------
## Example usage
```php
  require 'Namechk.php';
  $Namechk = new NamechkAPI();

  // Example Search ..

  //Search Youtube
  $Youtube = $Namechk->searchYoutube('Saleh7');
  print_r($Youtube);
```
