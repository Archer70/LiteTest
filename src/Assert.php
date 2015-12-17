<?php
namespace LiteTest\src;

class Assert
{
    public function true($value)
    {
        $this->failIf(!$value, 'Expected value to be TRUE.');
        return true;
    }

    public function false($value)
    {
        $this->failIf($value, 'Expected value to be FALSE.');
        return true;
    }

    public function isArray($array)
    {
        $this->failIf(!is_array($array), 'Expected value to be of type Array.');
        return true;
    }

    public function emptyArray(array $array)
    {
        $this->failIf(count($array) > 0, 'Expected array to be empty.');
        return true;
    }

    public function arrayNotEmpty(array $array)
    {
        $this->failIf(count($array) === 0, 'Expected array to hold value/s.');
        return true;
    }

    public function equal($expected, $actual)
    {
        $this->failIf($expected != $actual, '');
        return true;
    }

    public function exactEqual($expected, $actual)
    {
        $this->failIf($expected !== $actual, 'Expected values to be the same (===).');
        return true;
    }

    public function notEqual($expected, $actual)
    {
        $this->failIf($expected == $actual, 'Expected values to be different.');
        return true;
    }

    public function notExactEqual($expected, $actual)
    {
        $this->failIf($expected === $actual, 'Expected objects to be different (!==).');
        return true;
    }

    private function failIf($condition, $failureMessage)
    {
        if ($condition) {
            throw new AssertionException($failureMessage);
        }
    }
}
