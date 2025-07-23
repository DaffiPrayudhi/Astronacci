<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMembership
{
     public function handle(Request $request, Closure $next, $type)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();
        
        $membershipLevels = ['A' => 1, 'B' => 2, 'C' => 3];
        
        if ($membershipLevels[$user->membership_type] < $membershipLevels[$type]) {
            abort(403, 'Akses ditolak. Upgrade membership untuk mengakses fitur ini.');
        }

        return $next($request);
    }
}
