<?php
/**
 * Created by PhpStorm.
 * User: juwencheng
 * Date: 2018/12/7
 * Time: 3:20 PM
 */

namespace app\lib\tool;

/**
 * 说明，要使用redis，除了要安装redis外，还需要安装php的redis扩展
 * 扩展的在这里下载https://github.com/phpredis/phpredis/releases
 *
 */

use think\cache\driver\Redis;
use think\facade\Cache;

class CacheUtility {
	const options = [
		// 缓存类型为File
		'type'   => 'redis',
		'host'   => '127.0.0.1',
		// 全局缓存有效期（0为永久有效）
		'expire' => 0,
		// 缓存前缀
		'prefix' => 'videoparse',
	];

	public static function setSendCodeLimitation($key, $accessTimes, $timeout) {
		$redis = new Redis();
		Cache::connect( self::options)->set($key, $accessTimes, $timeout);
	}

	public static function getCodeLimitationValue($key) {
		return self::get($key);
	}

	public static function setCode( $code, $data ) {
		Cache::connect( self::options )->set( $code, $data, 600 );
	}

	public static function removeCode( $code ) {
		Cache::connect( self::options )->rm( $code );
	}

	/**
	 * 获取code对应的信息
	 *
	 * @param $code
	 *
	 * @return mixed
	 */
	public static function getCodeInformation( $code ) {
		return self::get( $code );
	}

	/**
	 * 设置验证码，超时10分钟
	 *
	 * @param $code
	 * @param $data
	 */
	public static function setToken( $token, $data ) {
		Cache::connect( self::options )->set( $token, $data, 0 );
	}

	public static function getTokenInformation( $token ) {
		return self::get( $token );
	}

	public static function get( $key ) {
		return Cache::connect( self::options )->get( $key );
	}
	public static function set($key, $value, $timeout) {
		return Cache::connect( self::options )->set($key, $value, $timeout);
	}
	public static function clean($key) {
		return Cache::connect(self::options)->rm($key);
	}
}