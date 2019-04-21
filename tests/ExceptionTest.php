<?php

use PHPUnit\Framework\TestCase;
use WriteiniFile\WriteiniFile;

class ExceptionTest extends TestCase
{
    private $file = 'tests/file_ini/CorruptiniFile.ini';

    public function testParseWithCorruptiniFile()
    {
        try {
            chmod($this->file, 0000);
            (new WriteiniFile($this->file));
            chmod($this->file, 0644);
        } catch (\Exception $error) {
        }

        $this->assertEquals("Unable to parse file ini: {$this->file}", $error->getMessage());
    }

    public function testWriteinCorruptiniFile()
    {
        try {
            chmod($this->file, 0644);
            $test = (new WriteiniFile($this->file))->create(['section 1' => ['foo' => 'string']]);
            chmod($this->file, 0000);
            $test->write();
            chmod($this->file, 0644);
        } catch (\Exception $error) {
        }

        $this->assertEquals("Unable to write in the file ini: {$this->file}", $error->getMessage());
    }
}
