<?php
namespace LiteTest\test;
use LiteTest\src\TestRunner;
use LiteTest\src\FileReader;
use LiteTest\test\runner_files\ExampleTest;
use LiteTest\test\helpers\FileSystem;
use LiteTest\test\mocks\TestSpyTest;

class TestRunnerTest extends \PHPUnit_Framework_TestCase
{
    private $runner;

    public function setUp()
    {
        $this->runner = new TestRunner(
            new FileReader(__DIR__ . '/runner_files'));
    }

    public function testCreatesNewInstancesOfTestClasses()
    {
        foreach ($this->runner->getTestObjects() as $object) {
            $this->assertContains(get_class($object), FileSystem::testClasses());
        }
    }

    public function testGetsMethodNames()
    {
        $testMethods = $this->runner->findTestObjectMethods(new ExampleTest);
        $this->assertContains('testDoesSomething', $testMethods);
        $this->assertContains('testDoesSomethingElse', $testMethods);
        $this->assertTrue(count($testMethods) == 2);
    }

    public function testRunsTestMethods()
    {
        $runner = new TestRunner(
            new FileReader(__DIR__ . '/mocks'));
        $runner->runTests();
        $this->assertTrue(TestSpyTest::$didSomething);
        $this->assertTrue(TestSpyTest::$didSomethingElse);
    }
}
