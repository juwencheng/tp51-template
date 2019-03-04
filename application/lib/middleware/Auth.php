<?php

namespace app\lib\middleware;
use app\lib\tool\TokenUtility;
use think\facade\Request;
use app\lib\exception\TokenException;

class Auth
{
    public function handle($request, \Closure $next)
    {
    	$token = $request->header("token");
    	if (!TokenUtility::isValidateToken($token)) {
				throw TokenException::InvalidTokenException();
	    }
    	return $next($request);
    }
}
