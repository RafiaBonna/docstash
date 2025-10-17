<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DepoMiddleware
{
    /**
     * Handle an incoming request.
     * শুধুমাত্র Depo (role_id = 2) ইউজারদের অ্যাক্সেস দেয়।
     */
    public function handle(Request $request, Closure $next): Response
    {
        // নিশ্চিত করুন যে ব্যবহারকারী লগইন করা আছে এবং তার role_id হলো 2
        if (Auth::check() && Auth::user()->role_id === 2) {
            return $next($request);
        }

        // অনুমতি না থাকলে /home রুটে এরর মেসেজ সহ রিডাইরেক্ট করুন
        return redirect('/home')->with('error', 'অনুমতি নেই। এই অ্যাক্সেস শুধুমাত্র ডেপো ইউজারদের জন্য সংরক্ষিত।');
    }
}
