<?php
use Illuminate\Database\Seeder;
class WeaponsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// 生成武器的初始数据
		DB::table ( 'weapons' )->insert ( [ 
				[ 
						'id' => 1,
						'name' => '木剑',
						'picture' => 'wp00000001',
						'content' => '木头做成的剑，适合练习使用',
						'attack' => '10',
						'defense' => '0',
						'life' => '50',
						'crit' => 2,
						'criticaldamage' => 0,
						'area' => '1',
						'grade' => 1 
				],
				[ 
						'id' => 2,
						'name' => '铁剑',
						'picture' => 'wp00000002',
						'content' => '由铁铸成的剑，比木头的硬，也更加锋利',
						'attack' => '15',
						'defense' => '0',
						'life' => '100',
						'crit' => 3,
						'criticaldamage' => 1,
						'area' => '1',
						'grade' => 2 
				],
				[ 
						'id' => 3,
						'name' => '钢剑',
						'picture' => 'wp00000003',
						'content' => '精钢武器，具有不俗的杀伤力',
						'attack' => '25',
						'defense' => '5',
						'life' => '120',
						'crit' => 5,
						'criticaldamage' => 3,
						'area' => '1',
						'grade' => 3 
				],
				[ 
						'id' => 4,
						'name' => '皮甲',
						'picture' => 'wp00000004',
						'content' => '兽皮制成的甲胄，是最初级的甲胄',
						'attack' => '0',
						'defense' => '20',
						'life' => '200',
						'crit' => 0,
						'criticaldamage' => 0,
						'area' => '2',
						'grade' => 1 
				],
				[ 
						'id' => 5,
						'name' => '钢甲',
						'picture' => 'wp00000005',
						'content' => '精钢甲胄，具有不俗的防御力',
						'attack' => '0',
						'defense' => '30',
						'life' => '350',
						'crit' => 5,
						'criticaldamage' => 0,
						'area' => '3',
						'grade' => 2 
				],
				[ 
						'id' => 6,
						'name' => '木盾',
						'picture' => 'wp00000006',
						'content' => '木头做成的盾，防御力值得商榷',
						'attack' => '0',
						'defense' => '10',
						'life' => '35',
						'crit' => 0,
						'criticaldamage' => 0,
						'area' => '3',
						'grade' => 1 
				],
				[ 
						'id' => 7,
						'name' => '铁盾',
						'picture' => 'wp00000007',
						'content' => '铁盾，厚实但笨重',
						'attack' => '2',
						'defense' => '20',
						'life' => '40',
						'crit' => 1,
						'criticaldamage' => 0,
						'area' => '3',
						'grade' => 2 
				],
				[ 
						'id' => 8,
						'name' => '皮盔',
						'picture' => 'wp00000008',
						'content' => '兽皮制成的头盔，轻便且具有一定的防御力',
						'attack' => '0',
						'defense' => '10',
						'life' => '50',
						'crit' => 0,
						'criticaldamage' => 0,
						'area' => '4',
						'grade' => 1 
				],
				[ 
						'id' => 9,
						'name' => '铁盔',
						'picture' => 'wp00000009',
						'content' => '铁盔，牺牲了轻便性，但防御力大大提高',
						'attack' => '0',
						'defense' => '25',
						'life' => '70',
						'crit' => 2,
						'criticaldamage' => 0,
						'area' => '4',
						'grade' => 2 
				],
				[ 
						'id' => 10,
						'name' => '布鞋',
						'picture' => 'wp00000010',
						'content' => '帆布制成的鞋，方便移动',
						'attack' => '0',
						'defense' => '10',
						'life' => '100',
						'crit' => 0,
						'criticaldamage' => 0,
						'area' => '5',
						'grade' => 1 
				],
				[ 
						'id' => 11,
						'name' => '烈火鞋',
						'picture' => 'wp00000011',
						'content' => '初级的魔法制品，在防御的同时，附带攻击效果',
						'attack' => '10',
						'defense' => '35',
						'life' => '250',
						'crit' => 5,
						'criticaldamage' => 3,
						'area' => '5',
						'grade' => 5 
				],
				[ 
						'id' => 12,
						'name' => '测试宠物1号',
						'picture' => 'wp00000012',
						'content' => '制作组设计的第一种宠物，简称测试宠物1号',
						'attack' => '100',
						'defense' => '50',
						'life' => '300',
						'crit' => 10,
						'criticaldamage' => 30,
						'area' => '6',
						'grade' => 3 
				],
				[ 
						'id' => 13,
						'name' => '测试宠物2号',
						'picture' => 'wp00000013',
						'content' => '制作组设计的第二种宠物，简称测试宠物2号，比1号强些',
						'attack' => '150',
						'defense' => '100',
						'life' => '500',
						'crit' => 12,
						'criticaldamage' => 32,
						'area' => '6',
						'grade' => 4 
				] 
		] );
	}
}
