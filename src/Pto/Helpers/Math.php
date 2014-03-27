<?php

namespace Pto\Helpers;

/**
 * @author Milan Matějček
 */
class Math extends Helper
{

    /**
     * upravi hodnotu v rozsahu intervalu pokud je mensi nez minimum tak na minimum,
     * pokud vetsi nez maximum tak na maximum, default is UNSIGNED
     * @param $number
     * @param $min FALSE|number
     * @param $max FALSE|number
     * @return number
     */
    static function interval($number, $min = 0, $max = FALSE)
    {
        if ($min === FALSE) {
            if ($min === $max) {
                return $number;
            }
            $min = $number;
        }

        if ($max === FALSE) {
            $max = $number;
        }
        return max($min, min($max, $number));
    }

    /**
     * prevede carky na tecky, to je potreba kdyz prevadi retezec na cislo >> 1,2 na 1.2
     *
     * @param string $string
     * @return string
     */
    static function stroke2point($string)
    {
        return str_replace(',', '.', $string);
    }

    /**
     * zaokrouhlujici metoda na padesatniky
     * @param number $num
     * @param number $q
     * @param fce $fce
     * @return number
     */
    static function round($num, $q = 5, $fce = 'ceil')
    {
        return $fce($num / $q) * $q;
    }

    /**
     * Returns least common multiple of two numbers
     * @param a number 1
     * @param b number 2
     * @return lcm(a, b)
     */
    static function lcm($a, $b)
    {
        if ($a == 0 || $b == 0) {
            return 0;
        }
        return ($a * $b) / self::gcd($a, $b);
    }

    /**
     * Returns greatest common divisor of the given numbers
     * @param a number 1
     * @param b number 2
     * @return gcd(a, b)
     */
    static function gcd($a, $b)
    {
        if ($a < 1 || $b < 1) {
            throw new RuntimeException("a or b is less than 1");
        }
        $remainder = 0;
        do {
            $remainder = $a % $b; //v tento okamzik v posledni iteraci plati ona podminka, ze zbytek == 0
            $a = $b; //ale kvuli dalsi pripadne iteraci posunujeme promenne
            $b = $remainder; //v b je proto 0, v a je gcd
        } while ($b != 0);
        return $a;
    }

    static function safeDivision($up, $down)
    {
        if (!$down) {
            return NULL;
        }
        return $up / $down;
    }

    /**
     * spocita faktorial
     * @param int $n
     * @return int
     */
    static function factorial($n)
    {
        if ($n == 0) {
            return 1;
        }
        if ($n < 0) {
            throw new LogicException("The number cann't negative number.");
        }
        return $n * self::factorial($n - 1);
    }

    /**
     * zjistuje, zda je cislo delitelne
     * @param int|float $delenec
     * @param int|float $delitel
     * @return bool
     */
    static public function isDivision($delenec, $delitel)
    {
        return ($delenec % $delitel) === 0;
    }

}
