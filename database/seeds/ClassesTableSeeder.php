<?php
use Illuminate\Database\Seeder;
class ClassesTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// 生成类型关联标号的初始数据(更改需谨慎)
		DB::table ( 'classes' )->insert ( [ 
				[ 
						'classname' => 'chests',
						'classnumber' => 1 
				],
				[ 
						'classname' => 'keys',
						'classnumber' => 2 
				],
				[ 
						'classname' => 'peteggs',
						'classnumber' => 3 
				],
				[
						'classname' => 'weapons',
						'classnumber' => 4
				]
		] );
	}
}
