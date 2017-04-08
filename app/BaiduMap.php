<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaiduMap extends Model {
	private $ak = 'XQBSCXFdxDbcndHFjH56lpKLNPm5VEqv';
	
	/**
	 * 坐标转换(国际经纬度坐标标准为WGS-84,国内必须至少使用国测局制定的GCJ-02,对地理位置进行首次加密)
	 *
	 * @param unknown $latitude        	
	 * @param unknown $longitude        	
	 * @return \Illuminate\Http\JsonResponse|unknown
	 */
	public function exchangeCoordinate($latitude, $longitude) {
		$url = 'http://api.map.baidu.com/geoconv/v1/?coords=' . $longitude . ',' . $latitude . '&ak=' . $this->ak . '&from=1&to=5';
		$url_respone_json = file_get_contents ( $url );
		$url_respone_obj = json_decode ( $url_respone_json );
		if ($url_respone_obj->status != 0) {
			$status = "700";
			return response ()->json ( [ 
					'status' => $status,
					'obj_status' => $url_respone_obj->status 
			] );
		}
		
		$coordinate ['longitude'] = $url_respone_obj->result [0]->x;
		$coordinate ['latitude'] = $url_respone_obj->result [0]->y;
		
		return $coordinate;
	}
	
	/**
	 * 通过地点数组，生成随机地点字符串，供LBS使用
	 *
	 * @return string
	 */
	public function randForPlace() {
		$place = array ();
		$place [0] = "美食";
		$place [1] = "购物";
		$place [2] = "景点";
		$place [3] = "娱乐";
		$place [4] = "教育";
		$place [5] = "交通设施";
		
		$rands = array (
				1,
				2,
				3,
				4,
				5 
		);
		$rand_result = array ();
		for($i = 0; $i < 3; $i ++) {
			$value = rand ( 0, count ( $rands ) - 1 );
			$rand_result [$i] = $rands [$value];
			array_splice ( $rands, $value, 1 );
		}
		
		$result_place_value = $place [$rand_result [0]] . '$' . $place [$rand_result [1]] . '$' . $place [$rand_result [2]];
		return $result_place_value;
	}
	
	/**
	 * 获得最终LBS数据
	 * 
	 * @param unknown $place
	 * @param unknown $latitude
	 * @param unknown $longitude
	 * @return \Illuminate\Http\JsonResponse|NULL|\Illuminate\Http\JsonResponse|unknown
	 */
	public function getLbsInforMation($place, $latitude, $longitude) {
		$url = 'http://api.map.baidu.com/place/v2/search?query=' . $place . '&page_size=20&scope=2&location=' . $latitude . ',' . $longitude . '&radius=3000&page_num=0&output=json&ak=XQBSCXFdxDbcndHFjH56lpKLNPm5VEqv';
		$url_respone_json = file_get_contents ( $url );
		$url_respone_obj  = json_decode ( $url_respone_json );
		if ($url_respone_obj->status != 0) {
			$status = "701";
			return response ()->json ( [ 
					'status' => $status,
					'obj_status' => $url_respone_obj->status 
			] );
		}
		
		if ($url_respone_obj->total == 0) {
			$status = "713";
			return response ()->json ( [
					'status' => $status,
			] );
		}
		
		$place_information = array();
		$total =  $url_respone_obj->total;
		if ($total <= 3) {
			for($i = 0; $i < $total; $i ++) {
				$place_information [$i] ['num'] = $i;
			}
		} else {
			$place_information [0] ['num'] = rand ( 0, $total - 1 );
			$place_information [1] ['num'] = rand ( 0, $total - 1 );
			$place_information [2] ['num'] = rand ( 0, $total - 1 );
		}
		
		for ($i = 0; $i < count($place_information); $i++) {
			$remainder = $place_information[$i]['num'] % 20;
			$page_num = ( $place_information[$i]['num'] - $remainder) / 20;
			$place_information[$i]['place'] = $this->getOneLbsPlace($place, $latitude, $longitude, $remainder, $page_num);
		}
		
		return $place_information;
		
	}
	
	/**
	 * 获得单独需要的LBS数据
	 * 
	 * @param unknown $place
	 * @param unknown $latitude
	 * @param unknown $longitude
	 * @param unknown $remainder
	 * @param unknown $page_num
	 * @return \Illuminate\Http\JsonResponse|unknown
	 */
	private function getOneLbsPlace($place, $latitude, $longitude, $remainder, $page_num) {
		$url = 'http://api.map.baidu.com/place/v2/search?query=' . $place . '&page_size=20&scope=2&location=' . $latitude . ',' . $longitude . '&radius=3000&page_num='.$page_num.'&output=json&ak=XQBSCXFdxDbcndHFjH56lpKLNPm5VEqv';
		$url_respone_json = file_get_contents ( $url );
		$url_respone_obj  = json_decode ( $url_respone_json );
		if ($url_respone_obj->status != 0) {
			$status = "701";
			return response ()->json ( [
					'status' => $status,
					'obj_status' => $url_respone_obj->status
			] );
		}
		$place_information = $url_respone_obj->results[$remainder];
		return $place_information;
	} 
}
