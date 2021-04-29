<?php


//namespace App\Helpers;


class ArrayHelper
{

    public static function changeNullFieldsToEmptyString(array $array): array
    {
        foreach ($array as &$arrayValue) {
            foreach ($arrayValue as $itemKey => &$item) {
                $arrayValue[$itemKey] = $item ?? "";
                if (is_iterable($item)) {
                    foreach ($item as $key => &$value) {
                        $item[$key] = $value ?? "";
                    }
                }
            }
        }

        return $array;
    }
}