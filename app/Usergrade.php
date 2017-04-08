<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usergrade extends Model
{
	// 指定表名
	protected $table = 'usergrades';
	
	// 指定主键
	protected $primaryKey = 'id';
	
	// 关闭时间戳,不使用则必须关闭
	public $timestamps = true;
}
