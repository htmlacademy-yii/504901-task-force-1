<?php


namespace taskForce\classes;

use taskForce\ex\FileFormatException;
use taskForce\ex\SourceFileException;
use taskForce\utils\DataImporterGenerator;
use taskForce\utils\DataWriter;

class ConvertCsvToSql
{
    /**
     * @param string $fileName
     * @param array $columns
     * @param string $tableName
     * @throws FileFormatException
     * @throws SourceFileException
     */
    static function createSql(string $fileName, array $columns, string $tableName)
    {
        $loader = new DataImporterGenerator($fileName, $columns);
        $loader->import();
        $records = $loader->getData();
        $sqlFileName = preg_replace('/csv$/', 'sql', $fileName);
        $writer = new DataWriter($sqlFileName, $columns, $tableName);
        $writer->writeFile($records);
        print("Файл " . $sqlFileName . " успешно создан");
        print("<br>");
    }
}
