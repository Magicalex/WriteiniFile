## WriteIniFile

WriteIniFile php library for create, erase and update file ini.

## Installation

Use composer for install this library.

```bash
$ composer require 'magicalex/writeinifile:dev-master'
```

## Usage

```php
<?php
require 'vendor/autoload.php';

use WriteIniFile\WriteIniFile;

$data = [
    "fruit" => ['orange' => '100g', 'fraise' => '10g'],
    "legume" => ['haricot' => '20g', 'oignon' => '100g'],
    "jus" => ['orange' => '1L', 'pomme' => '1,5L', 'pamplemousse' => '0,5L'],
    "dessert" => ['tarte' => true, 'pomme' => false, 'riz' => true, 'sushi' => false]
];


// demo create file ini
$a = new WriteIniFile("test1.ini");
$a->create($data);
$a->write();

$b = new WriteIniFile("test2.ini");
$b->create($data);
$b->write();


// demo erase a file
$c = new WriteIniFile("test1.ini");
$c->erase();
$c->write(); // erase all the file


// demo update a file
$d = new WriteIniFile("test2.ini");
$d->update([
    "dessert" => ['sushi' => "j'adore les sushis!", 'riz' => false],
    "fruit" => ['orange' => '200g']
]);
$d->write();
```

## License

The WriteIniFile php library is released under the GNU General Public License v3.0.

https://github.com/Magicalex/WriteIniFile/blob/master/LICENSE.md
