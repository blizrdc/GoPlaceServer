<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Psy\Util\Json;
use Illuminate\Http\Request;

class Base extends Model {
	
	// 通过Collection生成Original数组
	public static function getOriginalArray(Collection $collection) {
		$OriginalArray = array ();
		foreach ( $collection as $key => $value ) {
			$OriginalArray [$key] = $value->getOriginal ();
		}
		return $OriginalArray;
	}
	
	// 业务错误的返回
	public static function errorByStatus($data) {
		echo Json::encode ( $data );
		exit ();
	}
	
	// 暴力访问的CSRF标签验证
	public static function tokenPasswdVerificate(Request $request, $_tokenpasswd) {
		if ($_tokenpasswd != $request->session ()->get ( "_tokenpasswd" )) {
			$status = '500';
			Base::errorByStatus ( [ 
					'status' => $status 
			] );
		}
	}
	
	// 用于Prompt的输入验证
	public static function promptGetVerificate($lat = -1, $lng = -1, $id = -1, $email = '') {
		if ($lat == -1 || $lng == -1 || $id == -1 || $email == '') {
			$status = '600';
			Base::errorByStatus([
					'status' => $status
			]);
		}
	}
}
