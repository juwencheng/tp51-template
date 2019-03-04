<?php
/**
 * Created by PhpStorm.
 * User: juwencheng
 * Date: 2018/12/18
 * Time: 11:17 AM
 */

namespace app\lib\exception;


class ParseException {
	public static function VideoInfoNotFoundInUrlException($url) {
		return new BaseException([
			"errcode" => 1001,
			'errmsg' => "没有从链接中找到视频相关的信息",
			"request_url" => $url
		]);
	}
}