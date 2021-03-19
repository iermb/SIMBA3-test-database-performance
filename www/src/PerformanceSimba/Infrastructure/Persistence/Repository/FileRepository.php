<?php


namespace App\PerformanceSimba\Infrastructure\Persistence\Repository;


class FileRepository
{
    private const MODE_OPEN_FILE = 'a+';
    private const END_OF_LINE_CHAR = "\r\n";
    private $fp;

    public function __construct(string $filename)
    {
        $this->fp = fopen($filename . '.sql', self::MODE_OPEN_FILE);
    }

    public function __destruct()
    {
        fclose($this->fp);
    }

    public function writeLine(string $line): void
    {
        fwrite($this->fp, trim($line) . self::END_OF_LINE_CHAR);
    }
}