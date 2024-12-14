<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $whoCanAccess): Response
    {

        // General user roles
        $user_abilities = auth()->user()->roles;

        // Roels set to the token
        // $user_abilities = auth()->user()->currentAccessToken()->abilities;

        $route_abilities = explode('|', $whoCanAccess);

        $match = array_intersect(
            $user_abilities,
            $route_abilities
        );


        if (count( $match) === 0) {
            throw new \Exception('You have no access to this page');
        }

        return $next($request);
    }
}



