<?php
/**
 * Created by PhpStorm.
 * User: juwencheng
 * Date: 2018/12/7
 * Time: 8:01 AM
 */

namespace app\lib\middleware;

use think\facade\Request;

// 计算方法耗时
class Time {
	public function handle( Request $request, \Closure $next ) {
		// 开始时间
		$start    = time();
		$response = $next( $request );
		// 结束时间
		$delta = time() - $start;
		Log::record( "访问接口: " . $request->url() . "消耗时间：" . $delta, [ 'type' => 'info' ] );
	}
}