<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class SpecialitySeeder extends CsvSeeder
{
	public function __construct()
	{
		$this->table = 'specialities';
		$this->filename = base_path().'/database/seeds/csvs/specialities.csv';
	}

	public function run()
	{
		// Recommended when importing larger CSVs
		DB::disableQueryLog();

		// Uncomment the below to wipe the table clean before populating
		// DB::table($this->table)->truncate();

		parent::run();
	}
}
