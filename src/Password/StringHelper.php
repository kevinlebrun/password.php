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
        return $this->isCharBetween(0, 9, $letter);
    }

    protected function isLowerCase($letter)
    {
        return $this->isCharBetween('a', 'z', $letter);
    }

    protected function isUpperCase($letter)
    {
        return $this->isCharBetween('A', 'Z', $letter);
    }

    protected function isCharBetween($i, $j, $char)
    {
        return ord($i) <= ord($char) && ord($char) <= ord($j);
    }
}
