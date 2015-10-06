<?php
namespace LiteTest\test;
use LiteTest\src\TestCase;

class TestCaseTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->testCase = new CoolTest();
	}
	
	/**
	 * @expectedException \LiteTest\src\AssertionException
	 */
	public function testCaseMakesAssertion()
	{
		$this->testCase->failTestForTrue();
	}
	
	public function testGetsAllTestMethods()
	{
		$this->assertEquals(
			['testMethod', 'testMethod2'], $this->testCase->getTests());
	}
}

class CoolTest extends TestCase
{
	public function failTestForTrue()
	{
		$this->assert->true(false);
	}
	
	public function testMethod()
	{}
	
	public function testMethod2()
	{}
}
