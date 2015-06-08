<?php
require 'WriteIniFile/WriteIniFile.php';
use \WriteIniFile\WriteIniFile;

class WriteIniFileTest extends \PHPUnit_Framework_TestCase
{
    public function testWrite()
    {
        $var = [
            'section 1' => [
                'foo' => 'string',
                'bool_true' => true,
                'bool_false' => false,
                'int_true' => 1,
                'int_false' => 0,
                'int' => 10,
                'float' => 10.3,
                'foo_array' => [
                    'string',
                    10.3,
                    true,
                    false
                ],
            ],
            'section 2' => [
                'foo' => 'string',
                'var' => 'string string',
                'bool_true_string' => 'true',
                'int_true_string' => '1',
                'int_false_string' => '0',
                'float_string' => '10.5L'
            ]
        ];

        //$a = new WriteIniFile('../file_ini/test1.ini');
        //$a->create($var);
        //$a->write();

        $this->assertFileEquals('tests/file_ini/test1.ini', 'tests/file_ini/test2.ini');
    }
}
