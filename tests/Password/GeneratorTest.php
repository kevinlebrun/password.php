<?php

namespace Password\Test;

use Password\Generator;
use Password\StringHelper;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new StringHelper();
    }

    public function testCanGenerateUniqueLowerCasePassword()
    {
        $generator = new Generator();
        $generator->setMinLength(8);
        $password = $generator->generate();

        assertInternalType('string', $password);
        assertEquals(8, strlen($password));
        assertEquals(8, $this->helper->countLowerCaseLetters($password));
        assertNotEquals($password, $generator->generate());
    }

    public function testCanGenerateUniquePasswordWithUpperCaseLetters()
    {
        $generator = new Generator();
        $generator->setNumberOfUpperCaseLetters(4);
        $password = $generator->generate();

        assertInternalType('string', $password);
        assertEquals(8, strlen($password));
        assertEquals(4, $this->helper->countLowerCaseLetters($password));
        assertEquals(4, $this->helper->countUpperCaseLetters($password));
        assertNotEquals($password, $generator->generate());
    }

    public function testCanGenerateUniquePasswordWithNumbers()
    {
        $generator = new Generator();
        $generator->setMinLength(4);
        $generator->setNumberOfNumbers(5);
        $password = $generator->generate();

        assertInternalType('string', $password);
        assertEquals(5, strlen($password));
        assertEquals(5, $this->helper->countNumbers($password));
        assertNotEquals($password, $generator->generate());
    }

    public function testCanGenerateUniquePasswordWithSymbols()
    {
        $generator = new Generator(8);
        $generator->setNumberOfSymbols(5);
        $password = $generator->generate();

        assertInternalType('string', $password);
        assertEquals(8, strlen($password));
        assertEquals(5, $this->helper->countSymbols($password));
        assertEquals(3, $this->helper->countLowerCaseLetters($password));
        assertNotEquals($password, $generator->generate());
    }
}
