<?php
/**
 * Created by PhpStorm.
 * User: juwencheng
 * Date: 2018/12/14
 * Time: 8:26 PM
 */

namespace app\lib\validator;


class DramaValidator extends RequestValidator {
	protected $rule = [
		"url" => "require|url"
	];
}