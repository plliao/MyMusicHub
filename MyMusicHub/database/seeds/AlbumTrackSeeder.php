<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class AlbumTrackSeeder extends CsvSeeder
{
    public $insert_chunk_size = 1000;

    protected $album_map = [];

    public function __construct()
    {
        $this->table = 'AlbumTrack';
		$this->csv_delimiter = ',';
        $this->filename = base_path().'/database/seeds/csvs/tracks3.csv';
		$this->offset_rows = 1;
        $this->mapping = [
            4 => 'AlbumId',
            0 => 'TrackId',
        ];
		$this->should_trim = true;
    }

    public function readRow( array $row, array $mapping )
    {
        $row_values = parent::readRow($row, $mapping);
        if (is_null($row_values['AlbumId']) or is_null($row_values['TrackId'])) 
            return [];
        if (array_key_exists($row_values['AlbumId'], $this->album_map)) 
        {
            $this->album_map[$row_values['AlbumId']] = $this->album_map[$row_values['AlbumId']] + 1;
        }
        else $this->album_map[$row_values['AlbumId']] = 1;
        $row_values['AlbumOrder'] = $this->album_map[$row_values['AlbumId']];
        return $row_values;
    }
    
    public function run()
    {
        //
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}
