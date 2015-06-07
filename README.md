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
$a = new WriteIniFile('file1.ini');
$a->create($data);
$a->write();

$b = new WriteIniFile('file2.ini');
$b->create($data);
$b->write();

$c = new WriteIniFile('file3.ini');
$c->create($data);
$c->write();

$c = new WriteIniFile('file4.ini');
$c->create($data);
$c->write();


// demo erase integrally the file
$d = new WriteIniFile('file1.ini');
$d->erase();
$d->write();


// demo update a file
$e = new WriteIniFile('file2.ini');
$e->update([
    'dessert' => ['sushi' => "j'adore les sushis!", 'riz' => false],
    'fruit' => ['orange' => '200g']
]);
$e->write();


// demo add a new values in the file ini
$f = new WriteIniFile('file3.ini');
$f->add([
    'user_admin' => ['alexandre' => true, 'paul' => false],
    'fruit' => ['citron' => '100g']
]);
$f->write();


// demo remove some values in the file ini
$g = new WriteIniFile('file4.ini');
$g->rm([
    'fruit' => ['orange' => '100g'],
    'legume' => ['haricot' => '20g', 'oignon' => '100g'],
    'jus' => ['orange' => '1L', 'pomme' => '1,5L', 'pamplemousse' => '0,5L'],
    'dessert' => ['tarte' => true, 'pomme' => false, 'riz' => true, 'sushi' => false],
    'type' => ['type_true' => true, 'type_false' => false]
]);
$g->write();
```

### output file

```bash
$ cat file1.ini
# empty
```

```bash
$ cat file2.ini

[fruit]
orange = "200g"
fraise = "10g"

[legume]
haricot = "20g"
oignon = "100g"

[jus]
orange = "1L"
pomme = "1,5L"
pamplemousse = "0,5L"

[dessert]
tarte = yes
pomme = no
riz = no
sushi = "j'adore les sushis!"

[type]
type_true = yes
type_false = no
```

```bash
$ cat file3.ini

[fruit]
orange = "100g"
fraise = "10g"
citron = "100g"

[legume]
haricot = "20g"
oignon = "100g"

[jus]
orange = "1L"
pomme = "1,5L"
pamplemousse = "0,5L"

[dessert]
tarte = yes
pomme = no
riz = yes
sushi = no

[type]
type_true = yes
type_false = no

[user_admin]
alexande = yes
paul = no
```
```bash
$ cat file4.ini

[fruit]
fraise = "10g"
```

## License

The WriteIniFile php library is released under the GNU General Public License v3.0.

https://github.com/Magicalex/WriteIniFile/blob/master/LICENSE.md
