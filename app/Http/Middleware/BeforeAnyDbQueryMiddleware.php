<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Closure;
use DB;
use App;

class BeforeAnyDbQueryMiddleware
{
    public function handle($request, \Closure $next)
    {
        DB::enableQueryLog();
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // Log::info(DB::getQueryLog());
        if(App::environment('local')){
            // dd(DB::getQueryLog());
        }
    }
}