<?php


namespace taskForce\utils;


use taskForce\ex\FileFormatException;
use taskForce\ex\SourceFileException;

class DataWriter
{
    private $filename;
    private $columns;
    private $tableName;
    private $fp;
    private $result = [];

    /**
     * DataWrite constructor.
     * @param string $filename Имя sql файла
     * @param array $columns Заголовки столбцов
     * @param string $tableName Имя таблицы
     */
    public function __construct(string $filename, array $columns, string $tableName)
    {
        $this->filename = $filename;
        $this->columns = $columns;
        $this->tableName = $tableName;
    }

    /**
     * Запись данных
     * @param array $data
     * @throws SourceFileException
     */
    public function writeFile(array $data): void
    {
        $this->fp = fopen($this->filename, 'w');
        if (!$this->fp) {
            throw new SourceFileException("Не удалось открыть файл на чтение");
        }
        $text = "INSERT INTO " . $this->tableName . " (" . implode(", ", $this->columns) . ") VALUES";
        foreach ($data as $row) {

        }
        foreach ($data as $row) {
            if (is_array($row)) {
                $text .= "\n(";
                $values = "";

                for ($i = 0; $i < count($row); $i++) {
                    $values .= "'" . $row[$i] . "',";
                }
                $values = substr($values, 0, strlen($values) - 1);
                $text .= $values . "),";
            }
        }
        $text = substr($text, 0, strlen($text) - 1) . ";";
        fwrite($this->fp, $text);
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

    /* private function getNextLine(): ?iterable
     {
         foreach () {
             yield fgetcsv($this->fp);
         }
         return null;
     }*/

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
