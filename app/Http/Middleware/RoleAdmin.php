<?php

namespace App\Http\Middleware;

use App\Constants\AppConstants;
use Closure;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class RoleAdmin
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request , Closure $next)
    {
        if (auth()->user() && auth()->user()->role == AppConstants::ROLE_ADMIN){
            return $next($request);
        }

        throw new UnauthorizedHttpException('Unauthorized');
    }
}
