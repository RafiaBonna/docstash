<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DistributorMiddleware
{
    /**
     * Handle an incoming request.
     * এই মিডলওয়্যারটি শুধুমাত্র Distributor (role_id = 3) ইউজারদের অ্যাক্সেস দেয়।
     */
    public function handle(Request $request, Closure $next): Response
    {
        // নিশ্চিত করুন যে ব্যবহারকারী লগইন করা আছে এবং তার role_id হলো 3
        if (Auth::check() && Auth::user()->role_id === 3) {
            return $next($request);
        }

        // অনুমতি না থাকলে /home রুটে এরর মেসেজ সহ রিডাইরেক্ট করুন
        return redirect('/home')->with('error', 'অনুমতি নেই। এই অ্যাক্সেস শুধুমাত্র ডিস্ট্রিবিউটরদের জন্য সংরক্ষিত।');
    }
}
