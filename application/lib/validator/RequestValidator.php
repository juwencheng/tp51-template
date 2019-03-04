<?php
/**
 * Created by PhpStorm.
 * User: juwencheng
 * Date: 2018/12/3
 * Time: 3:45 PM
 */

namespace app\lib\validator;

//用于校验请求相关信息
use app\lib\exception\ParameterException;
use think\Validate;
use think\facade\Request;

class RequestValidator extends Validate {
	public static function checking() {
		$validator = new static();
		$validator->checkParameters();
	}

	/**
	 * 校验参数，
	 *
	 * @param array $params 可以为空，为空时，参数通过$request->param()获取
	 *
	 * @return bool
	 * @throws ParameterException
	 */
	public function checkParameters($params = []) {
		if (empty($params)) {
			$request = Request::instance();
			$params  = $request->param();
		}
		$result  = $this->batch()->check( $params );
		if ( ! $result ) {
			$errors = array_values($this->error);
			throw new ParameterException( [
				'errdetail' => $this->error,
				'errmsg' => join(",", $errors)
			] );
		}
		return true;
	}
	public function iChecking($data) {
		$result = $this->batch()->check($data);
		if ( ! $result ) {
			throw new ParameterException( [
				'errmsg' => $this->error
			] );
		}

		return true;
	}

	private function doChecking() {
		$request = Request::instance();
		$params  = $request->param();
		$result  = $this->batch()->check( $params );
		if ( ! $result ) {
			throw new ParameterException( [
				'errmsg' => $this->error
			] );
		}

		return true;
	}

	protected function isPositiveInteger( $value, $rule = '', $data = '', $field = '' ) {
		if ( is_numeric( $value ) && is_int( $value + 0 ) && ( $value + 0 ) > 0 ) {
			return true;
		} else {
//			return $field . "必须是正整数";
			// 这里采用更灵活的方式， 但是存在的问题是提示不清晰
			$this->message[ $field ] = $field . "必须是正整数";

			return false;
		}
	}

	protected function isNotEmpty( $value, $rule = '' ) {
		return ! empty( $value );
	}

	protected function isIntegerString($value, $rule = '') {
		if (empty($value)) {
			return false;
		}
		$ids = explode(",", $value);
		if (count($ids) == 0) {
			return false;
		}
		foreach ($ids as $id) {
			$result = $this->isPositiveInteger($id);
			if (!$result) {
				return false;
			}
		}
		return true;
	}

	/**
	 * 根据设置的rule获取服务器传过来的参数
	 *
	 * @param $arrays
	 *
	 * @return array
	 */
	public function getDataByRules( $arrays ) {
		$newArray = [];
		foreach ( $this->rule as $key => $value ) {
			$newArray[ $key ] = $arrays[ $key ];
		}

		return $newArray;
	}

	public function isMobile( $value ) {
		$rule   = '^1(3|4|5|7|8)[0-9]\d{8}$';
		$result = preg_match( $rule, $value );

		return $result;
	}
}