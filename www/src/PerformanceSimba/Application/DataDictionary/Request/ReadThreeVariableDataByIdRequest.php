<?php


namespace App\PerformanceSimba\Application\DataDictionary\Request;


class ReadThreeVariableDataByIdRequest
{
    private array $ids1;
    private array $ids2;
    private array $ids3;

    private const FIELD_HEADER_VARS_1 = 'ids_1';
    private const FIELD_HEADER_VARS_2 = 'ids_2';
    private const FIELD_HEADER_VARS_3 = 'ids_3';

    public function __construct(array $idsRequest)
    {
        $this->ids1 = self::parseAssociativeArray($idsRequest, self::FIELD_HEADER_VARS_1);
        $this->ids2 = self::parseAssociativeArray($idsRequest, self::FIELD_HEADER_VARS_2);
        $this->ids3 = self::parseAssociativeArray($idsRequest, self::FIELD_HEADER_VARS_3);
    }

    private static function parseAssociativeArray(array $input, string $key): array {
        if (!isset($input[$key])) {
            return [];
        }

        if (!is_array($input[$key])) {
            return [$input[$key]];
        }

        return $input[$key];
    }

    public function getIds1(): array
    {
        return $this->ids1;
    }

    public function getIds2(): array
    {
        return $this->ids2;
    }

    public function getIds3(): array
    {
        return $this->ids3;
    }
}