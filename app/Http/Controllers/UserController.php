<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Userinfo;
use App\User;
use App\Usermoney;
use App\Weapon;
use App\Base;
use App\Userattribute;
use Psy\Util\Json;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller {
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
	}
	
	/**
	 * 用户登陆方法，通过传入的邮箱密码参数，进行登陆验证，以及用户的个人信息返回
	 *
	 * @param Request $request        	
	 * @return \Illuminate\Http\JsonResponse User All Information
	 */
	public function Login(Request $request) {
		$status = '200';
		// 二次判断是否由POST方法传入参数
		if (! $request->isMethod ( 'POST' )) {
			$status = '600';
			return response ()->json ( [ 
					'status' => $status 
			] );
		}
		
		// 获得账号密码信息
		$email = $request->input ( 'email' );
		$password = $request->input ( 'password' );
		
		// 账号验证
		if (! Auth::attempt ( [ 
				'email' => $email,
				'password' => $password 
		] )) {
			$status = '300';
			return response ()->json ( [ 
					'status' => $status 
			] );
		}
		
		// 通过邮箱获取用户id
		$user = User::where ( 'email', $email )->get ();
		$userid = $user [0] ['original'] ['id'];
		
		// 通过userid获取用户个人信息
		$userinfo = Userinfo::where ( 'userid', $userid )->get ();
		
		// 实例化用户，为接下来的数据查询使用
		$usermodel = new User ();
		
		// 获取用户武器，道具，金币等数据信息的Collection
		$badgeCollection = $usermodel->getBelongsByUseridMTM ( 'App\Badge', 'users_badges', 'userid', $userid, 'badgeid', 'number' )->get ();
		$fragmentCollection = $usermodel->getBelongsByUseridMTM ( 'App\Fragment', 'users_fragments', 'userid', $userid, 'fragmentid', 'number' )->get ();
		$chestCollection = $usermodel->getBelongsByUseridMTM ( 'App\Chest', 'users_chests', 'userid', $userid, 'chestid', 'number' )->get ();
		$weaponCollection = $usermodel->getBelongsByUseridMTM ( 'App\Weapon', 'users_weapons', 'userid', $userid, 'weaponid', 'used' )->get ();
		$keyCollection = $usermodel->getBelongsByUseridMTM ( 'App\Key', 'users_keys', 'userid', $userid, 'keyid', 'number' )->get ();
		$peteggCollection = $usermodel->getBelongsByUseridMTM ( 'App\Petegg', 'users_peteggs', 'userid', $userid, 'peteggid', 'number' )->get ();
		$moneyCollection = Usermoney::where ( 'userid', $userid )->select ( 'money' )->get ();
		$attributeCollection = Userattribute::where ( 'userid', $userid )->get ();
		
		// 通过各种Collection获得Original的数组
		$badges = Base::getOriginalArray ( $badgeCollection );
		$fragments = Base::getOriginalArray ( $fragmentCollection );
		$chests = Base::getOriginalArray ( $chestCollection );
		$weapons = Base::getOriginalArray ( $weaponCollection );
		$keys = Base::getOriginalArray ( $keyCollection );
		$peteggs = Base::getOriginalArray ( $peteggCollection );
		$moneys = Base::getOriginalArray ( $moneyCollection );
		$attribute = Base::getOriginalArray ( $attributeCollection );
		
		// 使用csrf_token设置用户访问密钥，防止暴力访问
		$request->session ()->put ( '_tokenpasswd', csrf_token () );
		
		// 获得用户任务是否进行
		$task_status_value = Redis::get ( $userid . ':' . $email . ':taskstatus' );
		
		// 以json格式返回数据
		return response ()->json ( [ 
				'status' => $status,
			    'userAllInfo' => [ 
						'id' => $user [0] ['original'] ['id'],
						'name' => $user [0] ['original'] ['name'],
						'email' => $user [0] ['original'] ['email'],
						'age' => $userinfo [0] ['attributes'] ['age'],
						'sex' => $userinfo [0] ['attributes'] ['sex'],
						'phone' => $userinfo [0] ['attributes'] ['phone'],
						'head' => $userinfo [0] ['attributes'] ['head'] 
				],
				'badges' => $badges,
				'fragments' => $fragments,
				'chests' => $chests,
				'weapons' => $weapons,
				'keys' => $keys,
				'peteggs' => $peteggs,
				'moneys' => $moneys,
				'attribute' => $attribute,
				'task_status' => $task_status_value,
				'_tokenpasswd' => $request->session()->get('_tokenpasswd')
		] );
	}
}
