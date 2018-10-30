<?php

namespace App;

/**
 * Description of Xls2Csv2Db
 * Require pyton
 *
 * @author davidcallizaya
 */
class Xls2Csv2Db2
{

    const PYTON = 'python';
    const CONVERTER_CMD = '/bin/xlsx2csv.py';
    const CONVERTER_XLS2XLSX = '/bin/xls2xlsx';

    private $masterTable;

    public function __construct($masterTable)
    {
        $this->masterTable = $masterTable;
    }

    public function load($prefix, $file, $fillMergedCells = true, $ignoreEmptyRows = false)
    {
        $filepath = realpath($file);
        $isXsl = substr($filepath, -1, 1) === '.' || substr($filepath, -4, 4) === '.xls';
        if ($isXsl) {
            exec(
                base_path() .
                static::CONVERTER_XLS2XLSX .
                ' -o ' .
                escapeshellarg($filepath . '.xlsx') . ' ' .
                escapeshellarg($filepath)
            );
            $filepath = $filepath . '.xlsx';
        }
        $target = realpath(storage_path('/app')) . '/public/' . basename($filepath) . '.csv';
        exec(
            static::PYTON .
            ' ' .
            base_path() .
            static::CONVERTER_CMD . ' -d tab -a -e -l \'\\n\' -f %Y-%m-%d ' .
            ($fillMergedCells ? '-m ' : '') .
            ($ignoreEmptyRows ? '-i ' : '') .
            escapeshellarg($filepath) .
            ' > ' .
            escapeshellarg($target)
        );
        $handle = fopen($target, 'r');
        $nextIsSheet = false;
        $sheets = [];
        while (!feof($handle)) {
            $line0 = fgets($handle);
            $line = substr($line0, 0, -1);
            if (preg_match('/-------- (\d+) - (.+)/', $line, $match)) {
                $nextIsSheet = true;
                $sheet = new \stdClass();
                $sheet->number = $match[1];
                $sheet->source = $filepath;
                $sheet->name = $match[2];
                $sheet->table_name = $prefix . '_' . $sheet->number;
                $sheet->file = realpath(storage_path('/app')) . '/public/' .
                    basename($filepath) . '.' . $sheet->number . '.csv';
                $sheet->columns = [];
                $sheet->rows = 0;
                $sheets[] = $sheet;
                continue;
            }
            if ($nextIsSheet) {
                $nextIsSheet = false;
                $sheet->columns = explode("\t", $line);
                foreach ($sheet->columns as $i => $column) {
                    $sheet->columns[$i] = strtolower("Columna_" . $this->columnName($i));
                }
            }
            $sheet->rows++;
        }
        //remove count of the last empty line
        $sheet->rows--;
        fclose($handle);
        unlink($target);
        return $sheets;
    }

    public function importSheet($sheet, $fillMergedCells = true, $ignoreEmptyRows = false)
    {
        exec(
            static::PYTON .
            ' ' .
            base_path() .
            static::CONVERTER_CMD . ' -s ' . $sheet->number . ' -d tab -e -l \'\\n\' -f %Y-%m-%d ' .
            ($fillMergedCells ? '-m ' : '') .
            ($ignoreEmptyRows ? '-i ' : '') .
            escapeshellarg($sheet->source/* storage_path('/app/public/'.$sheet->source) */) .
            ' > ' .
            escapeshellarg($sheet->file)
        );
        $this->fixEmptyRowsBecauseExcelCursor($sheet->file);
        $sql = "drop table if exists " . $sheet->table_name . ";\n";
        $sql .= "create table if not exists " . $this->masterTable . "(\n";
        $sql .= "\"id\" serial NOT NULL,\n";
        $sql .= "\"filename\" text,\n";
        foreach ($sheet->columns as $i => $column) {
            $sql .= ($i === 0 ? "" : ",\n") . "    \"$column\" text NULL";
        }
        $sql .= "\n);";
        $sql .= "create table " . $sheet->table_name . "(\n";
        foreach ($sheet->columns as $i => $column) {
            $sql .= ($i === 0 ? "" : ",\n") . "    \"$column\" text NULL";
        }
        $sql .= "\n);";
        $sql .= "COPY " . $sheet->table_name . " FROM '" . $sheet->file . "' WITH DELIMITER '\t' CSV;\n";
        $sql .= "DELETE FROM " . $this->masterTable . " WHERE filename = '" . basename($sheet->source) . "';\n";
        $sql .= "INSERT INTO " . $this->masterTable . "(";
        foreach ($sheet->columns as $i => $column) {
            $sql .= ($i === 0 ? "" : ",") . $column;
        }
        $sql .= ", filename) SELECT *, '" . basename($sheet->source) . "' as filename FROM " . $sheet->table_name . ";\n";
        $sql .= "DROP TABLE " . $sheet->table_name . ";\n";
        return $sql;
    }

    private function fixEmptyRowsBecauseExcelCursor($filename)
    {
        copy($filename, $filename . '.tmp');
        $handle = fopen($filename . '.tmp', 'r');
        $handle1 = fopen($filename, 'w');
        while ($row = fgets($handle)) {
            if ($row === "\n")
                break;
            fwrite($handle1, $row);
        }
        fclose($handle);
        fclose($handle1);
        unlink($filename . '.tmp');
    }

    /**
     * Convierte en notacion de letras
     * 0=A, 1=B, ... 25=Z 26=AA, 27=AB
     *
     * @param int $num
     *
     * @return string
     */
    private function columnName($num)
    {
        $base = base_convert($num + floor($num / 26) + 1, 10, 27);
        $name = '';
        for ($i = 0, $l = strlen($base); $i < $l; $i++) {
            $c = ord($base[$i]);
            $name .= $c >= 48 && $c <= 57 ? chr($c - 48 + 64) : chr($c - 97 + 10 + 64);
        }
        return $name;
    }

    public function import(
    $prefix, $file, $fillMergedCells = true, $ignoreEmptyRows = false
    )
    {
        $sheets = $this->load($prefix, $file, $fillMergedCells, $ignoreEmptyRows);
        $sql = "begin;\n";
        foreach ($sheets as $sheet) {
            $sql .= $this->importSheet($sheet, $fillMergedCells,
                $ignoreEmptyRows);
        }
        $sql .= "\ncommit;\n";
        $tmpFile = uniqid('import_') . '.sql';
        \Storage::disk('local')->put($tmpFile, $sql);
        $pdo = \DB::getPdo();
        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, 0);
        $pdo->exec($sql);
        return $sheets;
    }
}
