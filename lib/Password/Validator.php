<?php

namespace Password;

class Validator
{
    protected $stringHelper;
    protected $minLength = 5;
    protected $minLowerCaseLetters = 0;
    protected $minUpperCaseLetters = 0;
    protected $minNumbers = 0;
    protected $minSymbols = 0;

    public function __construct(StringHelper $stringHelper)
    {
        $this->stringHelper = $stringHelper;
    }

    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;
    }

    public function setMinLowerCaseLetters($minLowerCaseLetters)
    {
        $this->minLowerCaseLetters = $minLowerCaseLetters;
    }

    public function setMinUpperCaseLetters($minUpperCaseLetters)
    {
        $this->minUpperCaseLetters = $minUpperCaseLetters;
    }

    public function setMinNumbers($minNumbers)
    {
        $this->minNumbers = $minNumbers;
    }

    public function setMinSymbols($minSymbols)
    {
        $this->minSymbols = $minSymbols;
    }

    public function isValid($string)
    {
        $string = (string) $string;

        $isValid = strlen($string) >= $this->minLength;
        $isValid = $isValid && $this->stringHelper->countLowerCaseLetters($string) >= $this->minLowerCaseLetters;
        $isValid = $isValid && $this->stringHelper->countUpperCaseLetters($string) >= $this->minUpperCaseLetters;
        $isValid = $isValid && $this->stringHelper->countNumbers($string) >= $this->minNumbers;
        $isValid = $isValid && $this->stringHelper->countSymbols($string) >= $this->minSymbols;

        return $isValid;
    }
}
