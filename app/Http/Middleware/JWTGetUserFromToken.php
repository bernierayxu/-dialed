<?php
namespace App\Http\Middleware;

use Closure;

use Tymon\JWTAuth\Middleware\GetUserFromToken;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JWTGetUserFromToken extends GetUserFromToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if (! $token = $this->auth->setRequest($request)->getToken()) {
            error('Missing Token', 'redirect');
        }

        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            error('Obsolete Token', 'redirect');
        } catch (JWTException $e) {
            error('Invalidate Token', 'redirect');
        }

        if (! $user) {
            error('Missing User', 'redirect');
        }
        
        if(!$user->user_types || $user->user_types->code != 'ADMIN') {
            error('Permission Denied', 'redirect');
        }

        // 如果发现user已经被blacklist了，那就invalidate这个token
        if ($user->deleted) {
            $this->auth->parseToken()->invalidate();
            error('Forbidden Login', 'redirect');
        }

        // $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}
