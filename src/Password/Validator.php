<?php

namespace Password;

class Validator
{
    const INVALID_LENGTH = 1;
    const INVALID_COUNT_LOWER_CASE_LETTERS = 2;
    const INVALID_COUNT_UPPER_CASE_LETTERS = 3;
    const INVALID_COUNT_NUMBERS = 4;
    const INVALID_COUNT_SYMBOLS = 5;

    protected $stringHelper;
    protected $minLength = 5;
    protected $minLowerCaseLetters = 0;
    protected $minUpperCaseLetters = 0;
    protected $minNumbers = 0;
    protected $minSymbols = 0;
    protected $errors = array();

    public function __construct(StringHelper $stringHelper)
    {
        $this->stringHelper = $stringHelper;
    }

    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;

        return $this;
    }

    public function setMinLowerCaseLetters($minLowerCaseLetters)
    {
        $this->minLowerCaseLetters = $minLowerCaseLetters;

        return $this;
    }

    public function setMinUpperCaseLetters($minUpperCaseLetters)
    {
        $this->minUpperCaseLetters = $minUpperCaseLetters;

        return $this;
    }

    public function setMinNumbers($minNumbers)
    {
        $this->minNumbers = $minNumbers;

        return $this;
    }

    public function setMinSymbols($minSymbols)
    {
        $this->minSymbols = $minSymbols;

        return $this;
    }

    public function isValid($string)
    {
        $this->errors = array();
        $string = (string) $string;

        if (strlen($string) < $this->minLength) {
            $this->errors[] = self::INVALID_LENGTH;
        }

        if ($this->stringHelper->countLowerCaseLetters($string) < $this->minLowerCaseLetters) {
            $this->errors[] = self::INVALID_COUNT_LOWER_CASE_LETTERS;
        }

        if ($this->stringHelper->countUpperCaseLetters($string) < $this->minUpperCaseLetters) {
            $this->errors[] = self::INVALID_COUNT_UPPER_CASE_LETTERS;
        }

        if ($this->stringHelper->countNumbers($string) < $this->minNumbers) {
            $this->errors[] = self::INVALID_COUNT_NUMBERS;
        }

        if ($this->stringHelper->countSymbols($string) < $this->minSymbols) {
            $this->errors[] = self::INVALID_COUNT_SYMBOLS;
        }

        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
