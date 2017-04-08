<?php
use Illuminate\Database\Seeder;
class PeteggsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// 生成宠物蛋的初始数据
		DB::table ( 'peteggs' )->insert ( [ 
				[ 
						'weaponid' => 12,
						'name' => '测试宠物1号的宠物蛋',
						'picture' => 'pe00000001',
						'requiredcost' => '10000',
						'grade' => 3
				],
				[ 
						'weaponid' => 13,
						'name' => '测试宠物2号的宠物蛋',
						'picture' => 'pe00000002',
						'requiredcost' => '15000',
						'grade' => 4 
				] 
		] );
	}
}
