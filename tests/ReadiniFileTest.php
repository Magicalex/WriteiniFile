<?php

use PHPUnit\Framework\TestCase;
use WriteiniFile\ReadiniFile;

class ReadiniFileTest extends TestCase
{
    public function testFileiniDoesnotExist()
    {
        try {
            ReadiniFile::get('tests/file_ini/fileDoesnotExist.ini');
        } catch (\Exception $error) {
        }

        $this->assertEquals('File ini does not exist: tests/file_ini/fileDoesnotExist.ini', $error->getMessage());
    }

    public function testUnabletoParseFileini()
    {
        try {
            chmod('tests/file_ini/CorruptiniFile.ini', 0000);
            ReadiniFile::get('tests/file_ini/CorruptiniFile.ini');
            chmod('tests/file_ini/CorruptiniFile.ini', 0644);
        } catch (\Exception $error) {
        }

        $this->assertEquals('Unable to parse file ini: tests/file_ini/CorruptiniFile.ini', $error->getMessage());
    }
}
