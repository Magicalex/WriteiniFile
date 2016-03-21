## WriteiniFile

Write-ini-file php library for create, remove, erase, add, and update ini file.

[![Build Status](https://travis-ci.org/Magicalex/WriteiniFile.svg)](https://travis-ci.org/Magicalex/WriteiniFile)
[![Coverage Status](https://coveralls.io/repos/Magicalex/WriteiniFile/badge.svg?branch=master&service=github)](https://coveralls.io/github/Magicalex/WriteiniFile?branch=master)
[![Latest Stable Version](https://poser.pugx.org/magicalex/write-ini-file/v/stable)](https://packagist.org/packages/magicalex/write-ini-file)
[![Total Downloads](https://poser.pugx.org/magicalex/write-ini-file/downloads)](https://packagist.org/packages/magicalex/write-ini-file)
[![Latest Unstable Version](https://poser.pugx.org/magicalex/write-ini-file/v/unstable)](https://packagist.org/packages/magicalex/write-ini-file)
 [![License](https://poser.pugx.org/magicalex/write-ini-file/license)](https://packagist.org/packages/magicalex/write-ini-file)

## Installation

Use composer for install this library.

```bash
$ composer require magicalex/write-ini-file
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
];

// demo create ini file
$a = new WriteiniFile('file1.ini');
$a->create($data);
$a->write();

// create another ini file
$b = new WriteiniFile('file2.ini');
$b->create($data);
$b->write();

// demo update a file
$c = new WriteiniFile('file1.ini');
$c->update([
    'fruit' => ['orange' => '200g']
]);
$c->write();

// demo remove some values in the ini file
$d = new WriteiniFile('file2.ini');
$d->rm([
    'fruit' => ['orange' => '100g'],
    'legume' => ['haricot' => '20g'],
    'jus' => ['orange' => '1L']
]);
$d->write();
```

### output file

ex : file2.ini

```ini
[fruit]
fraise = "10g"

[legume]
oignon = "100g"

[jus]
pomme = "1,5L"
pamplemousse = "0,5L"
```


## Contributing

To run the unit tests:

```bash
$ php vendor/bin/phpunit
```

## License

The WriteiniFile php library is released under the GNU General Public License v3.0.

https://github.com/Magicalex/WriteiniFile/blob/master/LICENSE.md
