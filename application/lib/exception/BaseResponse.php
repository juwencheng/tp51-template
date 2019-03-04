<?php
/**
 * Created by PhpStorm.
 * User: juwencheng
 * Date: 2018/12/3
 * Time: 2:38 PM
 */

namespace app\lib\exception;


class BaseResponse {
//	public $code = 200;
	public $code = "success";
	public $msg = "";
	public $data;

	public function __construct($params = []) {
		if (!is_array($params)) {
			return;
		}
		if (array_key_exists('data', $params)) {
			$this->data = $params['data'];
		}
	}

	public static function success($data = []) {
		return json(
			new BaseResponse([
				'data' => $data
			])
		);
	}
}