<?php
/**
 * Created by PhpStorm.
 * User: juwencheng
 * Date: 2018/12/3
 * Time: 4:18 PM
 */

namespace app\lib\tool;


class TokenUtility {

	/**
	 * 获取长度为$length的随机字符串
	 *
	 * @param $length
	 *
	 * @return null|string
	 */
	public static function getRandChar( $length ) {
		$str    = null;
		$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$max    = strlen( $strPol ) - 1;

		for ( $i = 0; $i < $length; $i ++ ) {
			$str .= $strPol[ rand( 0, $max ) ];
		}

		return $str;
	}
	public static function getRandNumber($length) {
		$str    = null;
		$strPol = "0123456789";
		$max    = strlen( $strPol ) - 1;

		for ( $i = 0; $i < $length; $i ++ ) {
			$str .= $strPol[ rand( 0, $max ) ];
		}

		return $str;
	}

	public static function generateToken() {
		$randChar  = self::getRandChar( 32 );
		$timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
		$tokenSalt = config( 'secure.token_salt' );

		return md5( $randChar . $timestamp . $tokenSalt );
	}

	/**
	 * 判断传入的token是否存在
	 * @param $token
	 *
	 * @return bool
	 */
	public static function isValidateToken( $token ) {
		if ( is_null( $token ) || empty( $token ) ) {
			return false;
		}

		return true;
	}
}