<?php

namespace Password;

class StringHelper
{
    public function countLowerCaseLetters($string)
    {
        $count = 0;
        foreach (str_split($string) as $letter) {
            if ($this->isLowerCase($letter)) {
                $count++;
            }
        }

        return $count;
    }

    public function countUpperCaseLetters($string)
    {
        $count = 0;
        foreach (str_split($string) as $letter) {
            if ($this->isUpperCase($letter)) {
                $count++;
            }
        }

        return $count;
    }

    public function countNumbers($string)
    {
        $count = 0;
        foreach (str_split($string) as $letter) {
            if ($this->isNumber($letter)) {
                $count++;
            }
        }

        return $count;
    }

    public function countSymbols($string)
    {
        $count = 0;
        foreach (str_split($string) as $letter) {
            if ($this->isSymbol($letter)) {
                $count++;
            }
        }

        return $count;
    }

    protected function isSymbol($letter)
    {
        return !$this->isNumber($letter) && !$this->isLowerCase($letter) && !$this->isUpperCase($letter);
    }

    protected function isNumber($letter)
    {
        return ord(0) <= ord($letter) && ord($letter) <= ord(9);
    }

    protected function isLowerCase($letter)
    {
        return ord('a') <= ord($letter) && ord($letter) <= ord('z');
    }

    protected function isUpperCase($letter)
    {
        return ord('A') <= ord($letter) && ord($letter) <= ord('Z');
    }
}
