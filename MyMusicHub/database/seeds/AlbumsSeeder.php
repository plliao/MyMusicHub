<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class AlbumsSeeder extends CsvSeeder {
	
	public function __construct()
	{
		$this->table = 'albums';
		$this->csv_delimiter = ',';
		$this->filename = base_path().'/database/seeds/csvs/albums.csv';
		$this->offset_rows = 1;
		$this->mapping = [
			0 => 'AlbumId',
			1 => 'AlbumName',
			2 => 'AlbumReleaseDate',
		];
		$this->should_trim = true;
	}

	public function run()
	{
		// Recommended when importing larger CSVs
		DB::disableQueryLog();

		// Uncomment the below to wipe the table clean before populating
		//DB::table($this->table)->truncate();

		parent::run();
	}
}

