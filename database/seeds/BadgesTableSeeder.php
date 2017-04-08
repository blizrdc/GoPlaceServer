<?php
use Illuminate\Database\Seeder;
class BadgesTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// 生成徽章的初始数据
		DB::table ( 'badges' )->insert ( [ 
				[ 
						'id' => 1,
						'name' => '初见',
						'picture' => 'bd00000001',
						'content' => '初次登陆获得徽章，象征着对于游戏的热爱',
						'grade' => 7 
				],
				[ 
						'id' => 2,
						'name' => '不离不弃',
						'picture' => 'bd00000002',
						'content' => '内测用户，正式登陆获得的徽章',
						'grade' => 7 
				] 
		] );
	}
}
