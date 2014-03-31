#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

$generator = new \Password\Generator;
$generator->setMinLength(8);
$generator->setNumberOfUpperCaseLetters(2);
$generator->setNumberOfNumbers(2);
$generator->setNumberOfSymbols(1);

$password = $generator->generate();
echo 'password: ' . $password . PHP_EOL;

$validator = new \Password\Validator(new \Password\StringHelper);
$validator->setMinLength(5);
$validator->setMinLowerCaseLetters(2);
$validator->setMinUpperCaseLetters(1);
$validator->setMinNumbers(1);
$validator->setMinSymbols(3);

if ($validator->isValid($password)) {
    printf('password %s is valid' . PHP_EOL, $password);
} else {
    printf('password %s is invalid' . PHP_EOL, $password);
    var_dump($validator->getErrors());
}
