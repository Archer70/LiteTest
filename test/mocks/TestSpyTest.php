<?php
namespace LiteTest\test\mocks;
use LiteTest\src\TestCase;

class TestSpyTest extends TestCase
{
    public static $didSomething = false;
    public static $didSomethingElse = false;

    public function testDoesSomething()
    {
        self::$didSomething = true;
    }

    public function testDoesSomethingElse()
    {
        self::$didSomethingElse = true;
    }
}
