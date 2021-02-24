<?php


namespace App\PerformanceSimba\Application\DataDictionary\Request;


class ReadThreeVariableDataByIdRequest
{
    private array $ids1;
    private array $ids2;
    private array $ids3;

    public function __construct(string $chainIds1, string $chainIds2, string $chainIds3)
    {
        $this->ids1 = self::parseChainIds($chainIds1);
        $this->ids2 = self::parseChainIds($chainIds2);
        $this->ids3 = self::parseChainIds($chainIds3);
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

    private static function parseChainIds(string $chainIds): array
    {
        $ids = preg_split('/\|/', $chainIds);

        $ids = array_filter($ids, function($input){

            if (0 == strlen($input)) {
                return false;
            }

            if (!is_numeric($input)) {
                return false;
            }

            return true;
        });

        $ids = array_map(function($input){

            return (int) $input;

        }, $ids);

        $ids = array_unique($ids);

        return $ids;
    }

}