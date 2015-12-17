<?php
namespace LiteTest\test;
use LiteTest\src\ClassParser;

class ClassParserTest extends \PHPUnit_Framework_TestCase
{
    private $parser;

    public function setUp()
    {
        $this->parser = new ClassParser(
            __DIR__ . '/runner_files/ExampleTest.php');
    }

    /**
     * @expectedException \LiteTest\src\FileException
     * @expectedExceptionMessage File does not exist, or is not readable; check permissions.
     */
    public function testThrowsExceptionIfFileDoesntExist()
    {
        new ClassParser('/Fake.php');
    }

    public function testGetsNamespaceFromTestFile()
    {
        $namespace = $this->parser->getNamespaceOfFile();
        $this->assertEquals('LiteTest\\test\\runner_files', $namespace);
    }

    public function testGetsClassNameFromTestFile()
    {
        $class = $this->parser->getClassNameInFile();
        $this->assertEquals('LiteTest\\test\\runner_files\\ExampleTest', $class);
    }
}
