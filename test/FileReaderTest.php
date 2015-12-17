<?php
namespace LiteTest\test;
use LiteTest\src\FileReader;
use LiteTest\test\helpers\FileSystem;

class FileReaderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->runner = new FileReader(__DIR__ . '/runner_files');
    }

    public function testGetsTestFilesRecursively()
    {
        foreach (FileSystem::testFiles() as $file) {
            $this->assertContains($file, $this->runner->getTestFilePaths());
        }
    }

    public function testGetsClassNamesFromFiles()
    {
        foreach (FileSystem::testClasses() as $class) {
            $this->assertContains($class, $this->runner->getClassNamesFromFiles());
        }
    }
}
