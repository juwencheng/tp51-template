<?php
/**
 * Created by PhpStorm.
 * User: juwencheng
 * Date: 2018/12/6
 * Time: 7:19 PM
 */

namespace app\lib\tool;


class CodeUtility {
	public static function generateCode() {
		// 生成随机6位数
		$code = self::generateRandomNumber( 6 );
		// 判断是否重复
		$data = CacheUtility::getCodeInformation( $code );
		if ( is_null( $data ) || !$data ) {
			return $code;
		} else {
			return self::generateCode();
		}
	}

	public static function getCodeInformation( $code ) {
		return CacheUtility::getCodeInformation( $code );
	}

	public static function generateRandomNumber( $length ) {
		$str    = null;
		$strPol = "0123456789";
		$max    = strlen( $strPol ) - 1;
		for ( $i = 0; $i < $length; $i ++ ) {
			$str .= $strPol[ rand( 0, $max ) ];
		}

		return $str;
	}

	public static function checkCode( $code ) {

	}
}