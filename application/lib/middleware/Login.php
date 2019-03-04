<?php
/**
 * Created by PhpStorm.
 * User: juwencheng
 * Date: 2018/12/7
 * Time: 7:57 AM
 */

namespace app\lib\middleware;


use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use app\lib\tool\CacheUtility;
use app\lib\tool\TokenUtility;
use think\facade\Cache;

class Login {
	/**
	 * @param          $request
	 * @param \Closure $next
	 *
	 * @return mixed
	 * @throws TokenException
	 * @throws UserException
	 */
	public function handle( $request, \Closure $next ) {
		$token = $request->header( "token" );
		if (!TokenUtility::isValidateToken($token)) {
			throw TokenException::InvalidTokenException();
		}
		$userInfo = CacheUtility::getTokenInformation($token);
		if (!$userInfo) {
			throw UserException::InvalidTokenException();
		}
		// 从cache中获取token对应的个人信息
		$request->user_id = $userInfo["user_id"];
		return $next( $request );
	}
}