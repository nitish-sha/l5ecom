<?php

namespace 
App\Http\Middleware;


use Closure;
use Session;

use Illuminate\Support\Facades\Auth;


class LockAccount
{



    public function handle($request, Closure $next, $guard = null)

    {

        // if ($request->session()->has('locked')) {

        //     return redirect('/lockscreen');

        // }

        if ( time() - Session::get('last_activity') >= 1 ) {
            session(['locked' => 'true']);
            return redirect('lockscreen');
        }



        return $next($request);

    }

}
