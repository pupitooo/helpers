<?php

namespace Pto\Helpers;

/**
 * @author Milan Matějček
 */
class ArrayStatic extends Helper
{

    /**
     * without iterator
     * @param array $keysarray
     * @param array $valuesarray
     * @param type $value
     * @return type
     */
    static function combine(array $keysarray, array $valuesarray, $value = NULL)
    {
        $diff = count($keysarray) - count($valuesarray);

        if ($diff > 0) {
            $valuesarray = array_merge($valuesarray, array_fill(0, $diff, $value));
        }

        return array_combine($keysarray, $valuesarray);
    }

    /**
     * better implode with defined keys
     * @param type $glue
     * @param type $array
     * @param type $keys
     * @return type
     */
    static function concatWs($glue, $array /* , ... keys */)
    {
        $args = array_slice(func_get_args(), 2);
        if (!$args) {
            $args = array_keys((array) $array);
        }
        $out = NULL;
        foreach ($args as $v) {
            if (isset($array[$v]) && $array[$v] !== NULL) {
                if ($out) {
                    $out .= $glue;
                }
                $out .= $array[$v];
            }
        }
        return $out;
    }

    /**
     * unset keys from array
     * @param array $array
     * @param type $key
     */
    static function kUnset(array &$array, $key /* , .. keys . */)
    {
        $out = array();
        $args = array_slice(func_get_args(), 1);
        foreach ($args as $key) {
            if (array_key_exists($key, $array)) {
                $out[$key] = $array[$key];
                unset($array[$key]);
            }
        }
        return $out;
    }

    /**
     * udělá z pole array(0 => array('id' => 5, 'name' => 'foo'), 1 => array('id' => 6, 'name' => 'bar') ===> array(5 => 'foo', 6 => 'bar')
     * @param type $array
     * @param type $valueKey
     * @param type $keyKey
     * @return type
     */
    static function forSelectBox($array, $valueKey, $keyKey = NULL)
    {
        $out = array();
        foreach ($array as $k => $v) {
            $out[$keyKey === NULL ? $k : $v[$keyKey]] = $v[$valueKey];
        }
        return $out;
    }

}
