<?php
// <!-- on chope un header via la request commencant par x - - auth et si on a la bonne valeur besoin ou pas de config.
// 422 response -->
// 
namespace Pm\trustpackage\Http\Middleware;

use Closure;

class CheckSignature
{
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader('X-Header-Name') == True) {
            $value = $request->header('X-Header-Name');
            // Check if header value is not null also as config
            if(is_null($value) == False && is_null(config('trusted.app_key')) == False && $value == config.app_key  ){
                return $next($request);
            }
        }
        return response('unauthenticated', 403);
    
}