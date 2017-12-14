<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class TrackTableSeeder extends CsvSeeder
{
    public $insert_chunk_size = 1000;

    public function __construct()
    {
        $this->table = 'track';
		$this->csv_delimiter = ',';
        $this->filename = base_path().'/database/seeds/csvs/tracks2.csv';
		$this->offset_rows = 1;
        $this->mapping = [
            0 => 'TrackId',
            1 => 'TrackName',
            2 => 'TrackDuration',
            3 => 'TrackArtist',
            4 => 'AlbumId',
        ];
		$this->should_trim = true;
    }

    public function run()
    {
        //
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}
