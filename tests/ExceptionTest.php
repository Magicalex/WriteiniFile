<?php

use \WriteiniFile\WriteiniFile;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{
    private $var = [
        'section 1' => [
            'foo'        => 'string',
            'bool_true'  => true,
            'bool_false' => false,
            'int_true'   => 1,
            'int_false'  => 0,
            'int'        => 10,
            'float'      => 10.3,
        ],
    ];

    public function testLoadWithoutCorruptiniFile()
    {
        $file = 'tests/file_ini/corruptiniFile.ini';
        chmod($file, 0000);

        try {
            $object = new WriteiniFile($file);
        } catch (\Exception $e) {
            return;
        }

        $this->fail();
    }

    public function testWriteInCorruptiniFile()
    {
        $file = 'tests/file_ini/corruptiniFile.ini';
        chmod($file, 0644);

        try {
            $object = new WriteiniFile($file);
            $object->create($this->var);
            chmod($file, 0000);
            $object->write();
        } catch (\Exception $e) {
            return;
        }

        $this->fail();
    }
}
