<?php
use Illuminate\Database\Seeder;
class FragmentsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// 生成碎片的初始数据
		DB::table ( 'fragments' )->insert ( [ 
				[ 
						'id' => 1,
						'classnumber' => 1,
						'classid' => 1,
						'name' => '木头宝箱的碎片',
						'picture' => 'fg00000001',
						'requirednumber' => 40,
						'requiredcost' => 100 
				],
				[ 
						'id' => 2,
						'classnumber' => 2,
						'classid' => 1,
						'name' => '木头宝箱钥匙的碎片',
						'picture' => 'fg00000002',
						'requirednumber' => 40,
						'requiredcost' => 100 
				],
				[ 
						'id' => 3,
						'classnumber' => 3,
						'classid' => 1,
						'name' => '测试宠物1号的宠物蛋的碎片',
						'picture' => 'fg00000003',
						'requirednumber' => 40,
						'requiredcost' => 100 
				] 
		] );
	}
}
