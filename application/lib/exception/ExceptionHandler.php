<?php
/**
 * Created by PhpStorm.
 * User: juwencheng
 * Date: 2018/12/3
 * Time: 3:02 PM
 */

namespace app\lib\exception;


use think\exception\Handle;
use think\facade\Request;
use think\Log;

class ExceptionHandler extends Handle {
	private $httpcode;
	private $errcode;
	private $errmsg;
	private $errdetail;

	public function render( \Exception $e ) {
		if ( $e instanceof BaseException ) {
			$this->errmsg    = $e->errmsg;
			$this->errcode   = $e->errcode;
			$this->httpcode  = $e->httpcode;
			$this->errdetail = $e->errdetail;
		} else {
			return parent::render($e);
			$this->httpcode  = 500;
			$this->errcode   = 999;
			$this->errmsg    = "服务器内部错误";
			$this->errdetail = [
				"exception" => $e->getMessage()
			];
//			return parent::render($e);
		}
		$request = Request::instance();
		$result  = [
//			"code" => $this->errcode,
			"code"     => "error",
			"msg"      => $this->errmsg,
			"request_url" => $request->url()
		];
		if ( ! is_null( $this->errdetail ) ) {
			$result["errdetail"] = $this->errdetail;
		}

		return json( $result, $this->httpcode );
	}

	private function recordErrorLog( \Exception $e ) {
		Log::init( [
			'type'  => "File",
			'path'  => LOG_PATH,
			'level' => [ 'error' ]
		] );
		Log::record( $e->getMessage(), [ 'type' => 'error' ] );
	}
}