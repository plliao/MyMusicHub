<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class ArtistsSeeder extends CsvSeeder
{
    public $insert_chunk_size = 1000;

    public function __construct()
    {
        $this->table = 'Artists';
		$this->csv_delimiter = ',';
        $this->filename = base_path().'/database/seeds/csvs/artists2.csv';
		$this->offset_rows = 1;
        $this->mapping = [
            0 => 'ArtistId',
            1 => 'ArtistTitle',
            2 => 'ArtistDescription',
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
