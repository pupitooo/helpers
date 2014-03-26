<?php

namespace Pto;

/**
 * @example
 * echo RomeNumber::getRome(1968); // MCMLXVIII
 * echo RomeNumber::getArabic('MCMLXVIII'); // 1968
 * 
 * @see http://php.vrana.cz/rimske-cislice.php
 */
class RomeNumber extends Helpers
{

    static private $numbers = array(
        "M" => 1000, "CM" => 900,
        "D" => 500, "CD" => 400,
        "C" => 100, "XC" => 90,
        "L" => 50, "XL" => 40,
        "X" => 10, "IX" => 9,
        "V" => 5, "IV" => 4,
        "I" => 1
    );

    /**
     * prevede cislo na arabske cislo
     * @param int $number
     * @return string
     */
    static function getRome($number)
    {
        $return = NULL;
        foreach (self::$numbers as $key => $val) {
            $return .= str_repeat($key, floor($number / $val));
            $number %= $val;
        }
        return $return;
    }

    /**
     * prevede arabske cislo na rimnske
     * @param string $rome
     * @return int
     */
    static function getArabic($rome)
    {
        $rome = str_split(strtoupper((string) $rome));
        $return = 0;
        $move = FALSE;

        foreach ($rome as $key => $val) {
            if ($move === TRUE) {
                $move = FALSE;
                continue;
            }

            if (isset($rome[$key + 1]) && isset(self::$numbers[$val . $rome[$key + 1]])) {
                $return +=self::$numbers[$val . $rome[$key + 1]];
                $move = TRUE;
            } else {
                $return +=self::$numbers[$val];
            }
        }
        return $return;
    }

}
