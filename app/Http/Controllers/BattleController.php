<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Userattribute;
use Psy\Util\Json;
use App\Base;

class BattleController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
	}
	
	// 获得对战列表
	public function getList(Request $request) {
		$status = '200';
		if (Auth::check ()) {
			// 二次判断是否由POST方法传入参数
			if (! $request->isMethod ( 'POST' )) {
				$status = '600';
				return response ()->json ( [ 
						'status' => $status 
				] );
			}
			
			// 进行登陆方式验证，防止暴力登陆
			$_tokenpasswd = $request->input ( "_tokenpasswd" );
			Base::tokenPasswdVerificate ( $request, $_tokenpasswd );
			
			$primaryUserAttribute = new Userattribute ();
			$primaryUserAttribute ['grade'] = 1;
			$primaryUserAttribute ['attack'] = '5';
			$primaryUserAttribute ['defense'] = '5';
			$primaryUserAttribute ['life'] = '100';
			$primaryUserAttribute ['crit'] = 0;
			$primaryUserAttribute ['criticaldamage'] = 0;
			$primaryUserAttribute ['name'] = '初级电脑';
			
			$intermediateUserAttribute = new Userattribute ();
			$intermediateUserAttribute ['grade'] = 10;
			$intermediateUserAttribute ['attack'] = '20';
			$intermediateUserAttribute ['defense'] = '15';
			$intermediateUserAttribute ['life'] = '500';
			$intermediateUserAttribute ['crit'] = 10;
			$intermediateUserAttribute ['criticaldamage'] = 20;
			$intermediateUserAttribute ['name'] = '中级电脑';
			
			$advancedUserAttribute = new Userattribute ();
			$advancedUserAttribute ['grade'] = 20;
			$advancedUserAttribute ['attack'] = '40';
			$advancedUserAttribute ['defense'] = '30';
			$advancedUserAttribute ['life'] = '1000';
			$advancedUserAttribute ['crit'] = 20;
			$advancedUserAttribute ['criticaldamage'] = 25;
			$advancedUserAttribute ['name'] = '高级电脑';
			
			return response ()->json ( [ 
					'primary' => $primaryUserAttribute,
					'intermediate' => $intermediateUserAttribute,
					'advanced' => $advancedUserAttribute 
			] );
		} else {
			// 未登录
			$status = '400';
			return response ()->json ( [ 
					'status' => $status 
			] );
		}
	}
}
