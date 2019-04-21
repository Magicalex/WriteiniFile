<?php

use PHPUnit\Framework\TestCase;
use WriteiniFile\WriteiniFile;
use WriteiniFile\ReadiniFile;

class WriteIniFileTest extends TestCase
{
    private $var = [
        'section 1' => [
            'foo'        => 'string',
            'foo_string' => 'string',
            'bool_true'  => true,
            'bool_false' => false,
            'int_true'   => 1,
            'int_false'  => 0,
            'int'        => 10,
            'float'      => 10.3,
            'foo_array'  => [
                'string',
                10.3,
                true,
                false
            ]
        ],
        'section 2' => [
            'foo'              => 'string',
            'var'              => 'string string',
            'bool_true'        => true,
            'bool_false'       => false,
            'var_null'         => null,
            'int_true_string'  => '1',
            'int_false_string' => '0',
            'float_string'     => '10.5L',
            'empty_string'     => ''
        ]
    ];

    public function testCreate()
    {
        (new WriteiniFile('tests/file_ini/Create_test.ini'))
            ->create($this->var)
            ->write();

        $this->assertFileEquals('tests/file_ini/Create.ini', 'tests/file_ini/Create_test.ini');
    }

    public function testUpdate()
    {
        (new WriteiniFile('tests/file_ini/Update_test.ini'))
            ->create($this->var)
            ->update(['section 1' => ['foo' => 'bar', 'int' => 100]])
            ->write();

        $this->assertFileEquals('tests/file_ini/Update.ini', 'tests/file_ini/Update_test.ini');
    }

    public function testRm()
    {
        (new WriteiniFile('tests/file_ini/Rm_test.ini'))
            ->create($this->var)
            ->rm(['section 1' => ['foo' => 'string', 'int' => 10]])
            ->write();

        $this->assertFileEquals('tests/file_ini/Rm.ini', 'tests/file_ini/Rm_test.ini');
    }

    public function testErase()
    {
        (new WriteiniFile('tests/file_ini/Erase_test.ini'))
            ->create($this->var)
            ->write();

        (new WriteiniFile('tests/file_ini/Erase_test.ini'))
            ->erase()
            ->write();

        $this->assertFileEquals('tests/file_ini/Erase.ini', 'tests/file_ini/Erase_test.ini');
    }

    public function testAdd()
    {
        (new WriteiniFile('tests/file_ini/Add_test.ini'))
            ->create($this->var)
            ->add(['section 3' => ['foo' => 'bar', 'var_float' => 10.5]])
            ->write();

        $this->assertFileEquals('tests/file_ini/Add.ini', 'tests/file_ini/Add_test.ini');
    }

    public function testEscapeCharacters()
    {
        (new WriteiniFile('tests/file_ini/EscapeCharacters_test.ini'))
            ->create([
                'section 1' => [
                    'foo' => '/usr/bin/example --name="Greg\'s test" --output=./dist/',
                    'bar' => 'Exclamation!question?period.'
                ]
            ])
            ->write();

        $this->assertFileEquals('tests/file_ini/EscapeCharacters.ini', 'tests/file_ini/EscapeCharacters_test.ini');
    }

    public function testUnchangeData()
    {
        (new WriteiniFile('tests/file_ini/UnchangeData_test.ini'))
            ->create(ReadiniFile::data('tests/file_ini/UnchangeData.ini'))
            ->write();

        $this->assertFileEquals('tests/file_ini/UnchangeData.ini', 'tests/file_ini/UnchangeData_test.ini');
    }
}
