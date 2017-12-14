<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class TrackTableSeeder extends CsvSeeder
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

    public function run()
    {
        //
        DB::disableQueryLog();
        //DB::table($this->table)->truncate();
        parent::run();
    }
}
