<?php


namespace taskForce\classes;

use taskForce\exception\FileFormatException;
use taskForce\exception\SourceFileException;
use taskForce\utils\FileReader;
use taskForce\utils\FileWriter;

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
        $loader = new FileReader($fileName, $columns);
        $loader->checkFile();
        $loader->readFile();
        $records = $loader->getData();
        $sqlFileName = preg_replace('/csv$/', 'sql', $fileName);
        $writer = new FileWriter($sqlFileName, $columns, $tableName);
        $writer->writeFile($records);
        print("Файл " . $sqlFileName . " успешно создан");
        print("<br>");

    }
}
