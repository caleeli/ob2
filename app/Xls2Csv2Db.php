<?php

namespace app;

use DB;
use Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Model\StatisticalVariable;
use App\Model\SharedVariable;
use App\Model\AssociatedValue;
use App\Model\Dimension;
use App\Model\Report;
use App\Model\Folder;
use Auth;

/**
 * Description of Xls2Csv2Db
 * Require pyton
 *
 * @author davidcallizaya
 */
class Xls2Csv2Db
{
    const pyton = 'python';

    public $table_name = '';
    public $columns = [];

    /**
     *
     * @var Report $report
     */
    public $report;

    /**
     *
     * @var StatisticalVariable[]
     */
    public $variables = [];

    /**
     *
     * @var Dimension[]
     */
    public $dimensions = [];

    public function load($file, $fillMergedCells = true,
                         $ignoreEmptyRows = false)
    {
        $this->table_name = uniqid('tmp_');
        $filepath = realpath($file);
        $target = realpath(storage_path('/app')).'/public/'.basename($filepath).'.csv';
        exec(
            static::pyton.
            ' '.
            base_path().
            '/bin/xlsx2csv.py -d tab -a -e -l \'\\n\' -f %Y-%m-%d '.
            ($fillMergedCells ? '-m ' : '').
            ($ignoreEmptyRows ? '-i ' : '').
            escapeshellarg($filepath).
            ' > '.
            escapeshellarg($target)
        );
        $handle = fopen($target, 'r');
        $nextIsSheet = false;
        //$sheetHandler = 0;
        $sheets = [];
        while (!feof($handle)) {
            $line0 = fgets($handle);
            $line = substr($line0, 0, -1);
            if (preg_match('/-------- (\d+) - (.+)/', $line, $match)) {
                $nextIsSheet = true;
                //$sheetHandler && fclose($sheetHandler);
                $sheet = new \stdClass();
                $sheet->number = $match[1];
                $sheet->source = $filepath;
                $sheet->name = $match[2];
                $sheet->file = realpath(storage_path('/app')).'/public/'.
                    basename($filepath).'.'.$sheet->number.'.csv';
                $sheet->columns = [];
                $sheet->rows = 0;
                //$sheetHandler = fopen($sheet->file, 'w');
                $sheets[] = $sheet;
                continue;
            }
            if ($nextIsSheet) {
                $nextIsSheet = false;
                $sheet->columns = explode("\t", $line);
                foreach ($sheet->columns as $i => $column) {
                    $sheet->columns[$i] = "Columna_".$this->getNameFromNumber($i);
                }
                //$this->createTable($sheet);
            }
            $sheet->rows++;
            //fwrite($sheetHandler, $line0);
        }
        //remove count of the last empty line
        $sheet->rows--;
        //$sheetHandler && fclose($sheetHandler);
        fclose($handle);
        unlink($target);
        return $sheets;
    }

    public function importSheet($sheet, $fillMergedCells = true,
                                $ignoreEmptyRows = false)
    {
        exec(
            static::pyton.
            ' '.
            base_path().
            '/bin/xlsx2csv.py -s '.$sheet->number.' -d tab -e -l \'\\n\' -f %Y-%m-%d '.
            ($fillMergedCells ? '-m ' : '').
            ($ignoreEmptyRows ? '-i ' : '').
            escapeshellarg(storage_path('/app/public/'.$sheet->source)).
            ' > '.
            escapeshellarg($sheet->file)
        );
        //$this->createTable($sheet);
        $sql= "create table ".$sheet->table_name."(\n";
        foreach($sheet->columns as $i=>$column) {
            $sql.=($i===0?"":",\n")."    \"$column\" text NULL";
        }
        $sql.="\n);";
        $sql.= "COPY ".$sheet->table_name." FROM '".$sheet->file."' WITH DELIMITER '\t' CSV;\n";
        $sql.= 'ALTER TABLE "'.$sheet->table_name.'" ADD "id" serial NOT NULL;'."\n";
        //$connection->statement($sql);
        return $sql;
    }

    public function reload($table_name)
    {
        $this->table_name = $table_name;
        $this->columns = Schema::connection("datos")->getColumnListing($this->table_name);
        $this->loadVariables();
        $this->loadDimensions();
        $this->loadAssociatedValues();
    }

    protected function createTable($sheet)
    {
        Schema::connection("datos")->create(
            $sheet->table_name,
            function (Blueprint $table) use ($sheet) {
                $table->increments('id');
                foreach ($sheet->columns as $i => $column) {
                    if (!trim($column)) {
                        continue;
                    }
                    $table->string($column)->nullable();
                }
            }
        );
    }

    protected function loadVariables()
    {
        $variables = DB::connection("datos")->table($this->table_name)->select($this->columns[0])->distinct()->get();
        foreach ($variables as $row) {
            $name = $this->columns[0];
            $value = $row->$name;
            $variableName = $value;
            if (!isset($this->variables[$value])) {
                $this->variables[$value] = StatisticalVariable::firstOrNew(
                        [
                            'name' => $variableName,
                        ]
                );
            }
            $this->variables[$variableName]->type = $this->columns[1];
        }
    }

    protected function loadDimensions()
    {
        foreach ($this->columns as $i => $dimensionName) {
            if ($i < 2) {
                continue;
            }
            if (!empty($dimensionName) && !isset($this->dimensions[$dimensionName])) {
                $this->dimensions[$dimensionName] = Dimension::firstOrNew(
                        [
                            'name' => $dimensionName,
                        ]
                );
            }
        }
    }

    protected function loadAssociatedValues()
    {
        for ($i = 2, $l = count($this->columns); $i < $l; $i++) {
            $dimensionName = $this->columns[$i];
            $query = DB::connection("datos")->table($this->table_name)->select($dimensionName);
            $query->select($this->columns[$i]);
            $values = $query->distinct()->get();
            foreach ($values as $row) {
                $value = $row->$dimensionName;
                if (!empty($dimensionName) && !isset($this->associatedValues[$dimensionName][$value])) {
                    @$this->associatedValues[$dimensionName][$value] = AssociatedValue::firstOrNew(
                            [
                                'dimension_id' => $this->dimensions[$dimensionName]->id,
                                'value'        => $value,
                            ]
                    );
                }
            }
        }
    }

    protected function saveVariablesDimensions($reportName)
    {
        /* @var $folder Folder */
        /* @var $variable StatisticalVariable */
        /* @var $share SharedVariable */
        $folder = Folder::firstOrNew([
                'name' => $reportName,
        ]);
        if (!$folder->exists) {
            $folder->parent_id = null;
            $folder->owner_id = Auth::user() ? Auth::user()->id : 1;
            Auth::user() ? Auth::user()->id : 1;
            $folder->save();
        }
        foreach ($this->variables as $variable) {
            if (!$variable->exists) {
                $variable->save();
            }
            foreach ($variable->shares()->where('type', 'OWNER')->get() as $share) {
                $share->folder_id = $folder->id;
                $share->save();
            }
        }
        foreach ($this->dimensions as $dimension) {
            if (!$dimension->exists) {
                $dimension->save();
            }
        }
        return $folder->id;
    }

    protected function saveAssociatedValues()
    {
        foreach ($this->associatedValues as $associatedValues1) {
            foreach ($associatedValues1 as $associatedValue) {
                if (!$associatedValue->exists) {
                    $associatedValue->save();
                }
            }
        }
    }

    public function saveReport($reportName, $replace = true)
    {
        /* @var $res \Maatwebsite\Excel\Collections\SheetCollection */
        /* @var $report Report */
        $report = Report::firstOrNew([
                'name'     => $reportName,
                'owner_id' => Auth::user()->id,
        ]);
        $folder_id = $this->saveVariablesDimensions($reportName);
        $this->saveAssociatedValues();
        $report->folder_id = $folder_id;
        $this->report = $report;
        if (!$report->exists) {
            $report->table_name = preg_replace('/[^a-z0-9]/i', '_',
                                               uniqid($reportName));
        }
        if (!$report->exists || $replace) {
            if (!$report->exists) {
                $report->save();
            }
            Schema::connection("datos")->dropIfExists($report->table_name);
            Schema::connection("datos")->rename($this->table_name,
                                                $this->report->table_name);
        }
    }

    public function deleteTable()
    {
        $sql = "DROP TABLE ".$this->table_name;
        DB::connection("datos")->statement($sql);
    }

    public function getNameFromNumber($num)
    {
        return static::columnName($num);
    }

    public static function columnName($num)
    {
        $numeric = ($num /* - 1 */) % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval(($num - 1) / 26);
        if ($num2 > 0) {
            return static::columnName($num2).$letter;
        } else {
            return $letter;
        }
    }
}
