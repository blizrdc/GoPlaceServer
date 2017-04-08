<?php
use Illuminate\Database\Seeder;
class ChestsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// 生成宝箱的初始数据
		DB::table ( 'chests' )->insert ( [ 
				[ 
						'id' => 1,
						'name' => '木头宝箱',
						'picture' => 'ct00000001',
						'money' => 500,
						'grade' => 1 
				],
				[ 
						'id' => 2,
						'name' => '皮革宝箱',
						'picture' => 'ct00000002',
						'money' => 700,
						'grade' => 2 
				],
				[ 
						'id' => 3,
						'name' => '青铜宝箱',
						'picture' => 'ct00000003',
						'money' => 1000,
						'grade' => 3 
				] 
		] );
	}
}
