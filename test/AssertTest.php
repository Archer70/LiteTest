<?php
namespace LiteTest\test;
use LiteTest\src\Assert;

class AssertTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->assert = new Assert();
    }

    public function testAssertsTrue()
    {
        $this->assertTrue(
            $this->assert->true(true));
    }

    /**
     * @expectedException \LiteTest\src\AssertionException
     * @expectedExceptionMessage Expected value to be TRUE.
     */
    public function testAssertsTrueWithException()
    {
        $this->assert->true(false);
    }

    public function testAssertsFalse()
    {
        $this->assert->false(false);
    }

    /**
     * @expectedException \LiteTest\src\AssertionException
     * @expectedExceptionMessage Expected value to be FALSE.
     */
    public function testAssertsFalseWithException()
    {
        $this->assert->false(true);
    }

    public function testAssertsArray()
    {
        $this->assertTrue(
            $this->assert->isArray([]));
    }

    /**
     * @expectedException \LiteTest\src\AssertionException
     * @expectedExceptionMessage Expected value to be of type Array.
     */
    public function testAssertsIsArrayWithException()
    {
        $this->assert->isArray('string');
    }

    public function testAssertsEmptyArray()
    {
        $this->assertTrue(
            $this->assert->emptyArray([]));
    }

    /**
     * @expectedException \LiteTest\src\AssertionException
     * @expectedExceptionMessage Expected array to be empty.
     */
    public function testAssertsEmptyArrayWithException()
    {
        $this->assert->emptyArray(['content']);
    }

    public function testAssertsArrayNotEmpty()
    {
        $this->assertTrue(
            $this->assert->arrayNotEmpty(['content']));
    }

    /**
     * @expectedException \LiteTest\src\AssertionException
     * @expectedExceptionMessage Expected array to hold value/s.
     */
    public function testAssertsNotEmptyArrayWithException()
    {
        $this->assert->arrayNotEmpty([]);
    }

    public function testAssertsEqualValues()
    {
        $this->assertTrue(
            $this->assert->equal('val', 'val'));
    }

    /**
     * @expectedException \LiteTest\src\AssertionException
     */
    public function testAssertsEqualValuesWithException()
    {
        $this->assert->equal('val', 'diff');
    }

    public function testAssertsExectEqual()
    {
        $object = new Assert();
        $this->assertTrue(
            $this->assert->exactEqual($object, $object));
    }

    /**
     * @expectedException \LiteTest\src\AssertionException
     * @expectedExceptionMessage Expected values to be the same (===).
     */
    public function testAssertsExactEqualWithException()
    {
        $this->assert->exactEqual(
            new Assert(), new Assert());
    }

    public function testAssertsNotEqual()
    {
        $this->assertTrue(
            $this->assert->notEqual('val', 'diff'));
    }

    /**
     * @expectedException \LiteTest\src\AssertionException
     * @expectedExceptionMessage Expected values to be different.
     */
    public function testAssertsNotEqualWithException()
    {
        $this->assert->notEqual('val', 'val');
    }

    public function testAssertsNotExactEqual()
    {
        $this->assertTrue(
            $this->assert->notExactEqual(new Assert(), new Assert()));
    }

    /**
     * @expectedException \LiteTest\src\AssertionException
     * @expectedExceptionMessage Expected objects to be different (!==).
     */
    public function testAssertsNotExactEqualWithException()
    {
        $object = new Assert();
        $this->assert->notExactEqual($object, $object);
    }
}
