<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminPermissionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Check if user has any admin-related permissions
        $adminPermissions = $user->permissions()->whereIn('table_name', ['users', 'roles', 'courses', 'categories', 'stages']);
        $hasAdminPermission = $adminPermissions->isNotEmpty();

        if (!$hasAdminPermission) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
