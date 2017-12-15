<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class TracksSeeder extends CsvSeeder
{
    public $insert_chunk_size = 1000;

    public function __construct()
    {
        $this->table = 'Tracks';
		$this->csv_delimiter = ',';
        $this->filename = base_path().'/database/seeds/csvs/tracks3.csv';
		$this->offset_rows = 1;
        $this->mapping = [
            0 => 'TrackId',
            1 => 'TrackName',
            5 => 'ArtistId',
            2 => 'TrackDuration',
        ];
		$this->should_trim = true;
    }

    public function readRow( array $row, array $mapping )
    {
        $row_values = [];
        foreach ($mapping as $csvCol => $dbCol) {
            if (!isset($row[$csvCol]) || $row[$csvCol] === '') {
                $row_values[$dbCol] = NULL;
            }
            else {
                $row_values[$dbCol] = $this->should_trim ? trim($row[$csvCol]) : $row[$csvCol];
            }
            if (is_null($row_values[$dbCol])) 
                return [];
        }
        if ($this->hashable && isset($row_values[$this->hashable])) {
            $row_values[$this->hashable] =  Hash::make($row_values[$this->hashable]);
        }
        return $row_values;
    }
    
    public function run()
    {
        //
        DB::disableQueryLog();
        //DB::table($this->table)->truncate();
        parent::run();
    }
}
