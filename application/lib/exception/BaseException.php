<?php
/**
 * Created by PhpStorm.
 * User: juwencheng
 * Date: 2018/12/3
 * Time: 2:37 PM
 */

namespace app\lib\exception;

class BaseException extends \Exception {
	public $httpcode = 200;
	public $errcode = 400;
	public $errmsg = "";
	public $errdetail = []; // 应用场景是校验失败时，包含详细的信息

	public function __construct( $params = [] ) {
		if ( ! is_array( $params ) ) {
			return;
		}
		if ( array_key_exists( 'code', $params ) ) {
			$this->httpcode = $params["code"];
		}
		if ( array_key_exists( 'errcode', $params ) ) {
			$this->errcode = $params['errcode'];
		}
		if ( array_key_exists( 'errmsg', $params ) ) {
			$this->errmsg = $params["errmsg"];
		}
		if ( array_key_exists( 'errdetail', $params ) ) {
			$this->errdetail = $params["errdetail"];
		}
	}
}