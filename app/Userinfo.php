<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
	// 指定表名
	protected $table = 'users_info';
	
	// 指定主键名
	protected $primaryKey = 'userid';
	
	// 关闭时间戳,不使用则必须关闭
	public $timestamps = false;
}
