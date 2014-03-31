<?php

namespace Password\Test;

use Password\Validator;
use Password\StringHelper;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testCanValidateSimplePassword()
    {
        $validator = new Validator(new StringHelper);
        $validator->setMinLength(8);
        assertTrue($validator->isValid('foobar22'));
        assertTrue($validator->isValid('muchlongerpassword'));
        assertTrue($validator->isValid('lk8:!shf'));
        assertFalse($validator->isValid('jhsdf'));
    }

    public function testCanValidatePasswordWithLowerCaseLetters()
    {
        $validator = new Validator(new StringHelper);
        $validator->setMinLength(5);
        $validator->setMinLowerCaseLetters(6);
        assertFalse($validator->isValid('ALLUPPER'));
        assertTrue($validator->isValid('password'));
    }

    public function testCanValidatePasswordWithUpperCaseLetters()
    {
        $validator = new Validator(new StringHelper);
        $validator->setMinLength(8);
        $validator->setMinUpperCaseLetters(5);
        assertTrue($validator->isValid('passWORDS'));
        assertFalse($validator->isValid('password'));
        assertFalse($validator->isValid('PWORDS'));
    }

    public function testCanValidatePasswordWithNumbers()
    {
        $validator = new Validator(new StringHelper);
        $validator->setMinLength(8);
        $validator->setMinNumbers(5);
        assertTrue($validator->isValid('1N3RD007'));
        assertFalse($validator->isValid('password'));
    }

    public function testCanValidatePasswordWithSymbols()
    {
        $validator = new Validator(new StringHelper);
        $validator->setMinLength(8);
        $validator->setMinSymbols(2);
        assertTrue($validator->isValid('!pass.word'));
        assertFalse($validator->isValid('1N3RD007'));
    }

    public function testReturnsErrorCodeWhenLengthIsInvalid()
    {
        $validator = new Validator(new StringHelper);
        $validator->setMinLength(8);
        $validator->isValid('foo');
        assertContains($validator::INVALID_LENGTH, $validator->getErrors());
    }

    public function testReturnsErrorCodeWhenLowerCaseCountIsInvalid()
    {
        $validator = new Validator(new StringHelper);
        $validator->setMinLowerCaseLetters(5);
        $validator->isValid('FOO');
        assertContains($validator::INVALID_COUNT_LOWER_CASE_LETTERS, $validator->getErrors());
    }

    public function testReturnsErrorCodeWhenUpperCaseCountIsInvalid()
    {
        $validator = new Validator(new StringHelper);
        $validator->setMinUpperCaseLetters(5);
        $validator->isValid('foo');
        assertContains($validator::INVALID_COUNT_UPPER_CASE_LETTERS, $validator->getErrors());
    }

    public function testReturnsErrorCodeWhenNumbersCountIsInvalid()
    {
        $validator = new Validator(new StringHelper);
        $validator->setMinNumbers(1);
        $validator->isValid('foo');
        assertContains($validator::INVALID_COUNT_NUMBERS, $validator->getErrors());
    }

    public function testReturnsErrorCodeWhenSymbolsCountIsInvalid()
    {
        $validator = new Validator(new StringHelper);
        $validator->setMinSymbols(1);
        $validator->isValid('foo');
        assertContains($validator::INVALID_COUNT_SYMBOLS, $validator->getErrors());
    }
}
