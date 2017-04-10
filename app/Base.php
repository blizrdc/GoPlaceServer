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
	
	// 通过地理坐标计算距离
	public static function distanceBetween($fP1Lat, $fP1Lon, $fP2Lat, $fP2Lon) {
		$fEARTH_RADIUS = 6378137;
		//角度换算成弧度
		$fRadLon1 = deg2rad($fP1Lon);
		$fRadLon2 = deg2rad($fP2Lon);
		$fRadLat1 = deg2rad($fP1Lat);
		$fRadLat2 = deg2rad($fP2Lat);
		//计算经纬度的差值
		$fD1 = abs($fRadLat1 - $fRadLat2);
		$fD2 = abs($fRadLon1 - $fRadLon2);
		//距离计算
		$fP = pow(sin($fD1/2), 2) +
		cos($fRadLat1) * cos($fRadLat2) * pow(sin($fD2/2), 2);
		return intval($fEARTH_RADIUS * 2 * asin(sqrt($fP)) + 0.5);
	}
}
