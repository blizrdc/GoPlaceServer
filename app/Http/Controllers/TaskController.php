<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Json;
use App\BaiduMap;
use Illuminate\Support\Facades\Redis;
use App\Base;

class TaskController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
	}
	
	/**
	 * 通过百度地图开发者平台，进行GPS坐标模糊化(法律规定)，进行lbs服务，获得任务目标具体信息，生成任务--------待优化
	 *
	 * @param Request $request        	
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function Show(Request $request) {
		$status = '200';
		if (Auth::check ()) {
			// 二次判断是否由POST方法传入参数
			if (! $request->isMethod ( 'POST' )) {
				$status = '600';
				return response ()->json ( [ 
						'status' => $status 
				] );
			}
			
			// 获得用户基本信息
			$user = Auth::user ();
			
			// 获得POST参数
			$latitude = $request->input ( "latitude" );
			$longitude = $request->input ( "longitude" );
			$_tokenpasswd = $request->input ( "_tokenpasswd" );
			
			// 进行登陆方式验证，防止暴力登陆
			Base::tokenPasswdVerificate ( $request, $_tokenpasswd );
			
			// 生成LBS信息
			$baidumap = new BaiduMap ();
			$coordinate = $baidumap->exchangeCoordinate ( $latitude, $longitude );
			
			$result_place_value = $baidumap->randForPlace ();
			$place_information = $baidumap->getLbsInforMation ( $result_place_value, $latitude, $longitude );
			
			return response ()->json ( [ 
					'status' => $status,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'place_informations' => $place_information 
			] );
		} else {
			// 未登录
			$status = '400';
			return response ()->json ( [ 
					'status' => $status 
			] );
		}
	}
	
	/**
	 * 开始任务
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function Start(Request $request) {
		$status = '200';
		if (Auth::check ()) {
			// 二次判断是否由POST方法传入参数
			if (! $request->isMethod ( 'POST' )) {
				$status = '600';
				return response ()->json ( [ 
						'status' => $status 
				] );
			}
			
			// 获得用户基本信息
			$user = Auth::user ();
			
			// 判断是否还有未完成任务
			$task_status_value = Redis::get ( $user ['id'] . ':' . $user ['email'] . ':taskstatus' );
			if ($task_status_value == '1') {
				$status = '901';
				return response ()->json ( [ 
						'status' => $status 
				] );
			}
			
			// 获得POST参数
			$lat = $request->input ( "lat" );
			$lng = $request->input ( "lng" );
			$name = $request->input ( "name" );
			$address = $request->input ( "address" );
			$uid = $request->input ( "uid" );
			$_tokenpasswd = $request->input ( "_tokenpasswd" );
			
			// 进行登陆方式验证，防止暴力登陆
			Base::tokenPasswdVerificate ( $request, $_tokenpasswd );
			
			// 向Redis写入任务
			$task_status_key = $user ['id'] . ':' . $user ['email'] . ':taskstatus';
			$task_status_value = '1';
			$task_information_key = $user ['id'] . ':' . $user ['email'] . ':taskinformation';
			$task_information_value = $lat . ':' . $lng . ':' . $name . ':' . $address . ':' . $uid;
			Redis::set ( $task_status_key, $task_status_value );
			Redis::set ( $task_information_key, $task_information_value );
			
			return response ()->json ( [ 
					'status' => $status 
			] );
		} else {
			// 未登录
			$status = '400';
			return response ()->json ( [ 
					'status' => $status 
			] );
		}
	}
	
	/**
	 * 提示任务
	 *
	 * @param unknown $lat        	
	 * @param unknown $lng        	
	 * @param unknown $id        	
	 * @param string $email        	
	 * @return \Illuminate\Http\JsonResponse|unknown
	 */
	public function Prompt($latitude = -1, $longitude = -1, $id = -1, $email = '') {
		$status = '200';
		
		Base::promptGetVerificate ( $latitude, $longitude, $id, $email );
		// 判断是否还有未完成任务
		$task_status_value = Redis::get ( $id . ':' . $email . ':taskstatus' );
		if ($task_status_value == '0') {
			$status = '900';
			return response ()->json ( [ 
					'status' => $status 
			] );
		}
		
		// 处理初始坐标
		$baidumap = new BaiduMap ();
		$coordinate = $baidumap->exchangeCoordinate ( $latitude, $longitude );
		
		// 获得任务目地信息
		$task_information = explode ( ':', Redis::get ( $id . ':' . $email . ':taskinformation' ) );
		
		// 生成提示视图并展示
		$location = array ();
		$location ['latitude'] = $task_information [0];
		$location ['longitude'] = $task_information [1];
		$location ['mylat'] = $coordinate ['latitude'];
		$location ['mylng'] = $coordinate ['longitude'];
		return view ( 'prompt' )->with ( 'location', $location );
	}
	
	/**
	 * 任务验证
	 * 
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function Submit(Request $request) {
		$status = '200';
		if (Auth::check ()) {
			// 二次判断是否由POST方法传入参数
			if (! $request->isMethod ( 'POST' )) {
				$status = '600';
				return response ()->json ( [ 
						'status' => $status 
				] );
			}
			
			// 获得用户基本信息
			$user = Auth::user ();
			
			// 获得POST参数
			$latitude = $request->input ( "latitude" );
			$longitude = $request->input ( "longitude" );
			$_tokenpasswd = $request->input ( "_tokenpasswd" );
			
			// 进行登陆方式验证，防止暴力登陆
			Base::tokenPasswdVerificate ( $request, $_tokenpasswd );
			
			// 判断是否还有未完成任务
			$task_status_value = Redis::get ( $user ['id'] . ':' . $user ['email'] . ':taskstatus' );
			if ($task_status_value == '0') {
				$status = '900';
				return response ()->json ( [ 
						'status' => $status 
				] );
			}
			
			// 处理初始坐标
			$baidumap = new BaiduMap ();
			$coordinate = $baidumap->exchangeCoordinate ( $latitude, $longitude );
			
			// 获得任务目地信息
			$task_information = explode ( ':', Redis::get ( $user ['id'] . ':' . $user ['email'] . ':taskinformation' ) );
			 
			// 计算距离
			$distance = Base::distanceBetween ( $coordinate ['latitude'], $coordinate ['longitude'], $task_information [0], $task_information [1] );
			
			//返回信息
			if ($distance < 60) {
				// 向Redis写入任务
				$task_status_key = $user ['id'] . ':' . $user ['email'] . ':taskstatus';
				$task_status_value = '0';
				Redis::set ( $task_status_key, $task_status_value );
				Redis::delete ( $user ['id'] . ':' . $user ['email'] . ':taskinformation' );
				return response ()->json ( [
						'status' => $status,
						'message' => '恭喜你, 任务完成',
						'message_status' => '200'
				] );
			} else {
				return response ()->json ( [
						'status' => $status,
						'message' => '距离目的地还有' . $distance . '米',
						'message_status' => '300'
				] );
			}
		} else {
			// 未登录
			$status = '400';
			return response ()->json ( [ 
					'status' => $status 
			] );
		}
	}
}
