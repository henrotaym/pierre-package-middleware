<?php
// <!-- on chope un header via la request commencant par x - - auth et si on a la bonne valeur besoin ou pas de config.
// 422 response -->
// 
namespace Pm\Trustpackage\Http\Middleware;

use Closure;

class CheckSignature
{
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader('X-Header-Name') == True) {
            $value = $request->header('X-Header-Name');
            $key_app = config('trusted.app_key');
            // Check if header value is not null also as config
            if(is_null($value) == False && is_null($key_app) == False && $value == $key_app  ){
                return $next($request);
            }
        }
        return response('unauthenticated', 403);
    
}