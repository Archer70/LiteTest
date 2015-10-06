<?php
namespace LiteTest\src;

class TestCase
{
	protected $assert;
	
	public function __construct()
	{
		$this->assert = new Assert();
	}
	
	public final function getTests()
	{
		$methods = get_class_methods($this);
		$tests = [];
		foreach ($methods as $method) {
			if (preg_match('/^test[a-zA-Z0-9_\-]+$/', $method)) {
				$tests[] = $method;
			}
		}
		return $tests;
	}
}
