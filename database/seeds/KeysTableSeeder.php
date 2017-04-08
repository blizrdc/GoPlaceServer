<?php
use Illuminate\Database\Seeder;
class KeysTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// 生成钥匙的初始数据
		DB::table ( 'keys' )->insert ( [ 
				[ 
						'id' => 1,
						'name' => '木头宝箱钥匙',
						'picture' => 'ky00000001',
						'chestid' => 1,
						'grade' => 1 
				],
				[ 
						'id' => 2,
						'name' => '皮革宝箱钥匙',
						'picture' => 'ky00000002',
						'chestid' => 2,
						'grade' => 2 
				],
				[ 
						'id' => 3,
						'name' => '青铜宝箱钥匙',
						'picture' => 'ky00000003',
						'chestid' => 3,
						'grade' => 3 
				] 
		] );
	}
}
