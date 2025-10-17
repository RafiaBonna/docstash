<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * এই মিডলওয়্যারটি শুধু 'Admin' (role_id = 1) ইউজারদের অ্যাক্সেস দেয়।
     */
    public function handle(Request $request, Closure $next): Response
    {
        // নিশ্চিত করুন যে ব্যবহারকারী লগইন করা আছে এবং তার role_id === 1 (এডমিন)
        if (Auth::check() && Auth::user()->role_id === 1) {
            return $next($request);
        }

        // এডমিন না হলে /home রুটে এরর মেসেজ সহ রিডাইরেক্ট করুন
        // অথবা সরাসরি 403 Forbidden এরর দেখাতে পারেন: return abort(403);
        return redirect('/home')->with('error', 'Unauthorized access. Access restricted to Admin.');
    }
}
