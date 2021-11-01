<?php
// <!-- on chope un header via la request commencant par x - - auth et si on a la bonne valeur besoin ou pas de config.
// 422 response -->
// 
namespace Pierre\Trustpackage\Http\middleware;

use Closure;

class RequestHeader
{
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader('X-Header-Name')) {
            $value = $request->header('X-Header-Name');
            $key_app = config('trusted.app_key');
            // Check if header value is not null also as config
            if($value && $key_app && $value === $key_app  ){
                return $next($request);
            }
        }
        return response('unauthenticated', 401);
    }
}