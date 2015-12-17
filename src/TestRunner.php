<?php
namespace LiteTest\src;

class TestRunner
{
    private $fileReader;
    private $testObjects = [];

    public function __construct(FileReader $fileReader)
    {
        $this->fileReader = $fileReader;
    }

    public function getTestObjects()
    {
        $classes = $this->fileReader->getClassNamesFromFiles();
        $objects = [];
        foreach ($classes as $class) {
            $objects[] = new $class;
        }
        $this->testObjects = $objects;
        return $objects;
    }

    public function findTestObjectMethods(TestCase $object=null)
    {
        $object = null === $object ? $this->testObjects[0] : $object;
        $tests = [];
        foreach (get_class_methods($object) as $method) {
            if (preg_match('/^(test)/i', $method)) {
                $tests[] = $method;
            }
        }
        return $tests;
    }

    public function runTests()
    {
        $object = $this->getTestObjects();
        $methods = $this->findTestObjectMethods();
        foreach($methods as $method) {
            call_user_func([$object[0], $method]);
        }
    }
}
