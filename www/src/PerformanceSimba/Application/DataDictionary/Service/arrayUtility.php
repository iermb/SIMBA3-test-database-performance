<?php


namespace App\PerformanceSimba\Application\DataDictionary\Service;


class arrayUtility
{
    public static function parseAssociativeArray(array $input, string $key): array {
        if (!isset($input[$key])) {
            return [];
        }

        if (!is_array($input[$key])) {
            return [$input[$key]];
        }

        return $input[$key];
    }

    public static function getUniqueArray(array $input): array
    {
        return array_merge(array_map("unserialize", array_unique(array_map("serialize", $input))),[]);
    }
}