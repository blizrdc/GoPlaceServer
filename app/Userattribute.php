<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userattribute extends Model
{
	// 指定表名
	protected $table = 'users_attribute';
	
	// 指定主键
	protected $primaryKey = 'userid';
	
	// 关闭时间戳,不使用则必须关闭
	public $timestamps = false;
}
