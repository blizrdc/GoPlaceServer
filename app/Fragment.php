<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fragment extends Model
{
	// 指定表名
	protected $table = 'fragments';
	
	// 关闭时间戳,不使用则必须关闭
	public $timestamps = true;
}
