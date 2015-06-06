# FileIni

WriteIniFile php library for create, erase and update file ini.

# Installation

use composer for install this library

```bash
$ composer require magicalex/WriteIniFile
```

# Usage

```php
<?php
require 'vendor/autoload';

$data = [
    "fruit" => ['orange' => '100g', 'fraise' => '10g'],
    "legume" => ['haricot' => '20g', 'oignon' => '100g'],
    "jus" => ['orange' => '1L', 'pomme' => '1,5L', 'pamplemousse' => '0,5L'],
    "dessert" => ['tarte' => true, 'pomme' => false, 'riz' => true, 'sushi' => false]
];

// demo erase a file
$a = new WriteIniFile("test1.ini");
$a->create($data);
$a->write();
$a->erase();
$a->write(); // erase all the file

// demo create file ini
$b = new WriteIniFile("test2.ini");
$b->create($data);
$b->write();

// demo update a value
$c = new WriteIniFile("test2.ini");
$c->update([
    "dessert" => ['sushi' => "j'adore les sushis!", 'riz' => false],
]);
$c->write();
```
