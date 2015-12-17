<?php
namespace LiteTest\test\helpers;

class FileSystem
{
    public static function testClasses()
    {
        return [
            'LiteTest\\test\\runner_files\\ExampleTest',
            'LiteTest\\test\\runner_files\\ExampleTwoTest',
            'LiteTest\\test\\runner_files\\recursive\\ExampleRecursiveTest'];
    }

    public static function testFiles()
    {
        $parent = dirname(__DIR__);
        return [
            $parent . '/runner_files/ExampleTest.php',
            $parent . '/runner_files/ExampleTwoTest.php',
            $parent . '/runner_files/recursive/ExampleRecursiveTest.php'];
    }
}
