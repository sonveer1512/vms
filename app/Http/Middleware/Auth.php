<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $email = Cookie::get('login_email');
        $password = Cookie::get('login_pass');

        if (!empty($email) && !empty($password)) {

            $check = UserModel::where('email', $email)->first();

            if (!empty($check)) {
                $data2 = UserModel::where('email', $email)->where('flag', '0')->first();

                if (!empty($data2)) {
                    if ($password == $data2->password) {

                        Cookie::queue('login_email', $email, time() + 60 * 60 * 24 * 100);
                        Cookie::queue('login_pass', $password, time() + 60 * 60 * 24 * 100);

                        $session['user_session'] = ['email' => $data2->email, 'name' => $data2->name, 'id' => $data2->id, 'authtoken' => $data2->token, 'user_auth' => true];
                        Session::put($session);
                    } else {
                        Session::flash('message', 'Your Password is updated. Please login again');
                        return redirect('/admin');
                    }
                } else {
                    Session::flash('message', 'Your account is deactivated by Admin. Please contact admin');
                    return redirect('/admin');
                }
            } else {
                Session::flash('message', 'Email address not found');
                return redirect('/admin');
            }
        } else {
            return redirect('/admin');
        }

        return $next($request);
    }
}
