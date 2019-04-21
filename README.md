## WriteiniFile

Write-ini-file php library for create, remove, erase, add, and update ini file.

[![Build Status](https://travis-ci.org/Magicalex/WriteiniFile.svg)](https://travis-ci.org/Magicalex/WriteiniFile)
[![Coverage Status](https://coveralls.io/repos/github/Magicalex/WriteiniFile/badge.svg?branch=master)](https://coveralls.io/github/Magicalex/WriteiniFile?branch=master)
[![StyleCI](https://styleci.io/repos/36994392/shield?branch=master)](https://styleci.io/repos/36994392)
[![Latest Stable Version](https://poser.pugx.org/magicalex/write-ini-file/v/stable)](https://packagist.org/packages/magicalex/write-ini-file)
[![Total Downloads](https://poser.pugx.org/magicalex/write-ini-file/downloads)](https://packagist.org/packages/magicalex/write-ini-file)
[![Latest Unstable Version](https://poser.pugx.org/magicalex/write-ini-file/v/unstable)](https://packagist.org/packages/magicalex/write-ini-file)
 [![License](https://poser.pugx.org/magicalex/write-ini-file/license)](https://packagist.org/packages/magicalex/write-ini-file)

## Installation

Use composer for install this library.

```bash
$ composer require magicalex/write-ini-file:1.2.*
```

## Usage

```php
<?php

require_once 'vendor/autoload.php';

use WriteiniFile\WriteiniFile;
use WriteiniFile\ReadiniFile;

$data = [
    'fruit' => ['orange' => '100g', 'fraise' => '10g'],
    'legume' => ['haricot' => '20g', 'oignon' => '100g'],
    'jus' => ['orange' => '1L', 'pomme' => '1,5L', 'pamplemousse' => '0,5L'],
];

// demo create ini file
$file_a = new WriteiniFile('file_a.ini');
$file_a
    ->create($data)
    ->add(['music' => ['rap' => true, 'rock' => false]])
    ->rm(['jus' => ['pomme' => '1,5L']])
    ->update(['fruit' => ['orange' => '200g']])
    ->write();

echo '<pre>'.file_get_contents('file_a.ini').'</pre>';

/* output file_a.ini
[fruit]
orange=200g
fraise=10g

[legume]
haricot=20g
oignon=100g

[jus]
orange=1L
pamplemousse=0,5L

[music]
rap=true
rock=false
*/

$file_b = (new WriteiniFile('file_b.ini'))->erase()->write();

// file.ini -> empty

// Just read a file ini
var_dump(ReadiniFile::data('file_a.ini'));

/* output
array(4) {
  'fruit' =>
  array(2) {
    'orange' =>
    string(4) "200g"
    'fraise' =>
    string(3) "10g"
  }
  'legume' =>
  array(2) {
    'haricot' =>
    string(3) "20g"
    'oignon' =>
    string(4) "100g"
  }
  'jus' =>
  array(2) {
    'orange' =>
    string(2) "1L"
    'pamplemousse' =>
    string(4) "0,5L"
  }
  'music' =>
  array(2) {
    'rap' =>
    string(4) "true"
    'rock' =>
    string(5) "false"
  }
}
*/

```

## Contributing

To run the unit tests:

```bash
composer install
php vendor/bin/phpunit # or composer run-script test
```

## License

The WriteiniFile php library is released under the [GNU General Public License v3.0](https://github.com/Magicalex/WriteiniFile/blob/master/LICENSE)
