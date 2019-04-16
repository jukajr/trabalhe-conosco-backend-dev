<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// $this->download();
		// $this->desconpactfile();
		$this->loadData();
	}

	public function download() {
		$path = base_path() . '/public/downloads/users.csv.gz';
		$file_path = fopen($path, 'w');
		$client = new \GuzzleHttp\Client();
		$client->get(env('DOWNLOAD_URL'), ['save_to' => $file_path]);
	}

	public function desconpactfile() {
		$path = base_path() . '/public/downloads/users.csv.gz';

		shell_exec('gunzip ' . $path);
	}

	public function loadData() {
		$path = base_path() . '/public/downloads/users.csv';
		$file = fopen($path, 'r');
		$control = 0;
		$data = [];

		while (($line = fgetcsv($file)) !== FALSE) {
			$data[] = [
				'uid' => $line[0],
				'name' => $line[1],
				'username' => $line[2],
			];

			$control = $control++;
			$this->insertData($data);

			if ($control === 1024) {
				$this->insertData($data);
				$control = 0;
				$data = [];
			}
		}
		fclose($file);
	}

	public function insertData($data) {
		DB::table('users')->insert($data);
	}
}
