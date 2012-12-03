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
}
