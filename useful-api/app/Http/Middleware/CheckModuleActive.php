<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $moduleId = $request->route('module_id');

        if (!$user || !$user->user_modules()->where('module_id', $moduleId)->where('active', 1)->exists()) {
            return response()->json([
                'message' => 'Module inactive ou non attribué à l’utilisateur.'
            ], 403);
        }
        return $next($request);
    }
}
