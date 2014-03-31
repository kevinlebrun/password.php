<?php

namespace Password\Test;

use Password\Validator;
use Password\StringHelper;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected function createValidator()
    {
        $validator = new Validator(new StringHelper);
        $validator->setMinLength(8);
        return $validator;
    }

    public function testCanValidateSimplePassword()
    {
        $validator = $this->createValidator();
        assertTrue($validator->isValid('foobar22'));
        assertTrue($validator->isValid('muchlongerpassword'));
        assertTrue($validator->isValid('lk8:!shf'));
        assertFalse($validator->isValid('jhsdf'));
    }

    public function testCanValidatePasswordWithLowerCaseLetters()
    {
        $validator = $this->createValidator();
        $validator->setMinLowerCaseLetters(6);
        assertFalse($validator->isValid('ALLUPPER'));
        assertTrue($validator->isValid('password'));
    }

    public function testCanValidatePasswordWithUpperCaseLetters()
    {
        $validator = $this->createValidator();
        $validator->setMinUpperCaseLetters(5);
        assertTrue($validator->isValid('passWORDS'));
        assertFalse($validator->isValid('password'));
        assertFalse($validator->isValid('PWORDS'));
    }

    public function testCanValidatePasswordWithNumbers()
    {
        $validator = $this->createValidator();
        $validator->setMinNumbers(5);
        assertTrue($validator->isValid('1N3RD007'));
        assertFalse($validator->isValid('password'));
    }

    public function testCanValidatePasswordWithSymbols()
    {
        $validator = $this->createValidator();
        $validator->setMinSymbols(2);
        assertTrue($validator->isValid('!pass.word'));
        assertFalse($validator->isValid('1N3RD007'));
    }

    public function testReturnsErrorCodeWhenLengthIsInvalid()
    {
        $validator = $this->createValidator();
        $validator->isValid('foo');
        assertContains($validator::INVALID_LENGTH, $validator->getErrors());
    }

    public function testReturnsErrorCodeWhenLowerCaseCountIsInvalid()
    {
        $validator = $this->createValidator();
        $validator->setMinLowerCaseLetters(5);
        $validator->isValid('FOO');
        assertContains($validator::INVALID_COUNT_LOWER_CASE_LETTERS, $validator->getErrors());
    }

    public function testReturnsErrorCodeWhenUpperCaseCountIsInvalid()
    {
        $validator = $this->createValidator();
        $validator->setMinUpperCaseLetters(5);
        $validator->isValid('foo');
        assertContains($validator::INVALID_COUNT_UPPER_CASE_LETTERS, $validator->getErrors());
    }

    public function testReturnsErrorCodeWhenNumbersCountIsInvalid()
    {
        $validator = $this->createValidator();
        $validator->setMinNumbers(1);
        $validator->isValid('foo');
        assertContains($validator::INVALID_COUNT_NUMBERS, $validator->getErrors());
    }

    public function testReturnsErrorCodeWhenSymbolsCountIsInvalid()
    {
        $validator = $this->createValidator();
        $validator->setMinSymbols(1);
        $validator->isValid('foo');
        assertContains($validator::INVALID_COUNT_SYMBOLS, $validator->getErrors());
    }
}
