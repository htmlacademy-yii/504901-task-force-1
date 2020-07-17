<?php

namespace taskForce\utils;

use taskForce\exception\FileFormatException;
use taskForce\exception\SourceFileException;

class FileReader
{
    private $filename;
    private $columns;
    private $fp;
    private $result = [];

    /**
     * DataImporter constructor.
     * @param string $filename
     * @param array $columns
     */
    public function __construct(string $filename, array $columns)
    {
        $this->filename = $filename;
        $this->columns = $columns;

    }

    /** Формирование исключений
     * @throws FileFormatException
     * @throws SourceFileException
     */
    public function checkFile()
    {
        if (!$this->validateColumns($this->columns)) {
            throw new FileFormatException("Заданы неверные заголовки столбцов");
        }
        if (!file_exists($this->filename)) {
            throw new SourceFileException("Файл не существует");
        }
        $this->fp = fopen($this->filename, 'r');
        if (!$this->fp) {
            throw new SourceFileException("Не удалось открыть файл на чтение");
        }
        $header_data = $this->getHeaderData();
        $diff = array_diff($header_data, $this->columns);
        if ($diff) {
            throw new FileFormatException("Исходный файл не содержит необходимых столбцов");
        }

    }

    public function readFile(): void
    {
        foreach ($this->getNextLine() as $line) {
            $this->result[] = $line;
        }

    }

    public function getData(): array
    {

        return $this->result;
    }

    private function getHeaderData(): ?array
    {
        rewind($this->fp);

        return fgetcsv($this->fp);
    }

    private function getNextLine(): ?iterable
    {
        while (!feof($this->fp)) {
            yield fgetcsv($this->fp);
        }

        return null;
    }

    private function validateColumns(array $columns): bool
    {
        $result = true;
        if (count($columns)) {
            foreach ($columns as $column) {
                if (!is_string($column)) {
                    $result = false;
                }
            }
        } else {
            $result = false;
        }

        return $result;
    }
}
