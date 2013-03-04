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
        $string = (string) $string;

        $isValid = strlen($string) >= $this->minLength;
        $isValid = $isValid && $this->stringHelper->countLowerCaseLetters($string) >= $this->minLowerCaseLetters;
        $isValid = $isValid && $this->stringHelper->countUpperCaseLetters($string) >= $this->minUpperCaseLetters;
        $isValid = $isValid && $this->stringHelper->countNumbers($string) >= $this->minNumbers;
        $isValid = $isValid && $this->stringHelper->countSymbols($string) >= $this->minSymbols;

        return $isValid;
    }
}
