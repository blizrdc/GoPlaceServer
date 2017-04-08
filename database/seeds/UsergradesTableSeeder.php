<?php
use Illuminate\Database\Seeder;
class UsergradesTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// 生成等级初始属性的初始数据(更改需谨慎)
		DB::table ( 'usergrades' )->insert ( [ 
				[ 
						'id' => 1,
						'grade' => 1,
						'requiredexperience' => 100,
						'addattack' => '5',
						'adddefense' => '5',
						'addlife' => '100',
						'addcrit' => 0,
						'addcriticaldamage' => 0 
				],
				[ 
						'id' => 2,
						'grade' => 2,
						'requiredexperience' => 200,
						'addattack' => '5',
						'adddefense' => '5',
						'addlife' => '100',
						'addcrit' => 0,
						'addcriticaldamage' => 0 
				],
				[ 
						'id' => 3,
						'grade' => 3,
						'requiredexperience' => 500,
						'addattack' => '5',
						'adddefense' => '5',
						'addlife' => '100',
						'addcrit' => 0,
						'addcriticaldamage' => 0 
				],
				[ 
						'id' => 4,
						'grade' => 4,
						'requiredexperience' => 1000,
						'addattack' => '5',
						'adddefense' => '5',
						'addlife' => '100',
						'addcrit' => 0,
						'addcriticaldamage' => 0 
				],
				[ 
						'id' => 5,
						'grade' => 5,
						'requiredexperience' => 1500,
						'addattack' => '5',
						'adddefense' => '5',
						'addlife' => '100',
						'addcrit' => 0,
						'addcriticaldamage' => 0 
				],
				[ 
						'id' => 6,
						'grade' => 6,
						'requiredexperience' => 2200,
						'addattack' => '5',
						'adddefense' => '5',
						'addlife' => '100',
						'addcrit' => 0,
						'addcriticaldamage' => 0 
				],
				[ 
						'id' => 7,
						'grade' => 7,
						'requiredexperience' => 3000,
						'addattack' => '5',
						'adddefense' => '5',
						'addlife' => '100',
						'addcrit' => 0,
						'addcriticaldamage' => 0 
				]
		] );
	}
}
