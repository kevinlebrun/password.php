<?php

namespace Password\Test;

use Password\StringHelper;

// TODO detect unicode lower case letters and upper case letters
class StringHelperTest extends \PHPUnit_Framework_TestCase
{
    protected $analyser;

    public function setUp()
    {
        $this->analyser = new StringHelper();
    }

    public function testCountsLowerCaseLetters()
    {
        assertEquals(6, $this->analyser->countLowerCaseLetters('foobar'));
        assertEquals(4, $this->analyser->countLowerCaseLetters('FooBar'));
        assertEquals(2, $this->analyser->countLowerCaseLetters('F00Bar'));
    }

    public function testCountsUpperCaseLetters()
    {
        assertEquals(0, $this->analyser->countUpperCaseLetters('foobar'));
        assertEquals(3, $this->analyser->countUpperCaseLetters('!123abcXYZ'));
    }

    public function testCountsNumbers()
    {
        assertEquals(0, $this->analyser->countNumbers('foobar'));
        assertEquals(4, $this->analyser->countNumbers('!123abcXYZ0'));
    }

    public function testCountsSymbols()
    {
        assertEquals(1, $this->analyser->countSymbols('!123abcXYZ'));
        assertEquals(3, $this->analyser->countSymbols('!123@bc_XYZ'));
    }
}
