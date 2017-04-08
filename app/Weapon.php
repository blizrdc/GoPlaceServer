<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    // 指定表名
	protected $table = 'weapons';
	
	// 关闭时间戳,不使用则必须关闭
	public $timestamps = true;

}
