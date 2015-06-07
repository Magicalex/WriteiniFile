## WriteIniFile

WriteIniFile php library for create, erase and update file ini.

## Installation

Use composer for install this library.

```bash
$ composer require 'magicalex/write-ini-file:dev-master'
```

## Usage

```php
<?php
require 'vendor/autoload.php';

use \WriteIniFile\WriteIniFile;

$data = [
    'fruit' => ['orange' => '100g', 'fraise' => '10g'],
    'legume' => ['haricot' => '20g', 'oignon' => '100g'],
    'jus' => ['orange' => '1L', 'pomme' => '1,5L', 'pamplemousse' => '0,5L'],
    'dessert' => ['tarte' => true, 'pomme' => false, 'riz' => true, 'sushi' => false],
    'type' => ['type_true' => true, 'type_false' => false]
];

// demo create file ini
$a = new WriteIniFile('test1.ini');
$a->create($data);
$a->write();

$b = new WriteIniFile('test2.ini');
$b->create($data);
$b->write();


// demo erase integrally the file
$c = new WriteIniFile('test1.ini');
$c->erase();
$c->write();


// demo update a file
$d = new WriteIniFile('test2.ini');
$d->update([
    'dessert' => ['sushi' => "j'adore les sushis!", 'riz' => false],
    'fruit' => ['orange' => '200g']
]);
$d->write();


// demo add a new value in the file ini
$e = new WriteIniFile('test2.ini');
$e->add([
    'user_admin' => ['alexande' => true, 'paul' => false],
    'fruit' => ['citron' => '100g']
]);
$e->write();
```

## License

The WriteIniFile php library is released under the GNU General Public License v3.0.

https://github.com/Magicalex/WriteIniFile/blob/master/LICENSE.md
