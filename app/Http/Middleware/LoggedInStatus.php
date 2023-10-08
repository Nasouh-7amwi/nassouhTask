<?php

namespace App\Http\Middleware;

use App\Models\Subscriber;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoggedInStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::user()->status){
            $subscriber = Subscriber::query()->find(Auth::id());
            $subscriber->status = true;
            $subscriber->save();
        }else{
            return redirect('/log');
        }
        return redirect('/home2');
    }
}
