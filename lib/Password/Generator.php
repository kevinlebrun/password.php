<?php

namespace Password;

class Generator
{
    protected $minLength = 8;
    protected $numberOfUpperCaseLetters = 0;
    protected $numberOfNumbers = 0;
    protected $numberOfSymbols = 0;
    protected $lowerCaseLetters = 'abcdefghijklmnopqrstuvwxyz';
    protected $upperCaseLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    protected $numbers = '0123456789';
    protected $symbols = '#@_!.+-';

    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;
    }

    public function setNumberOfUpperCaseLetters($numberOfUpperCaseLetters)
    {
        $this->numberOfUpperCaseLetters = $numberOfUpperCaseLetters;
    }

    public function setNumberOfNumbers($numberOfNumbers)
    {
        $this->numberOfNumbers = $numberOfNumbers;
    }

    public function setNumberOfSymbols($numberOfSymbols)
    {
        $this->numberOfSymbols = $numberOfSymbols;
    }

    public function generate()
    {
        $password = $this->generateUpperCaseLetters() . $this->generateNumbers() . $this->generateSymbols();
        $password = $this->completeWithLowerCaseLetters($password);
        return str_shuffle($password);
    }

    protected function generateUpperCaseLetters()
    {
        $password = '';
        for ($i = 0; $i < $this->numberOfUpperCaseLetters; $i++) {
            $password .= $this->upperCaseLetters[(rand() % strlen($this->upperCaseLetters))];
        }

        return $password;
    }

    protected function generateSymbols()
    {
        $password = '';
        for ($i = 0; $i < $this->numberOfSymbols; $i++) {
            $password .= $this->symbols[(rand() % strlen($this->symbols))];
        }

        return $password;
    }

    protected function generateNumbers()
    {
        $password = '';
        for ($i = 0; $i < $this->numberOfNumbers; $i++) {
            $password .= $this->numbers[(rand() % strlen($this->numbers))];
        }

        return $password;
    }

    protected function completeWithLowerCaseLetters($password)
    {
        while (strlen($password) < $this->minLength) {
            $password .= $this->lowerCaseLetters[(rand() % strlen($this->lowerCaseLetters))];
        }

        return $password;
    }
}
