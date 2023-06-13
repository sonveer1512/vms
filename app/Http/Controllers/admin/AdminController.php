<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view('admins/index');
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {

            $data = UserModel::CheckLogin($request->email)->first();

            if (!empty($data)) {
                if (Hash::check($request->password, $data->password)) {

                    $exist = [
                        'email' => $request->email,
                        'id' => $data->id,
                        'role' => $data->role,
                        'name' => $data->name,
                        'user_auth' => true
                    ];

                    Cookie::queue('login_email', $request->email, time() + 60 * 60 * 24 * 100);
                    Cookie::queue('login_pass', $data->password, time() + 60 * 60 * 24 * 100);

                    $session['user_session'] = $exist;
                    Session::put($session);

                    return response()->json(['message' => 'Login Successfully', 'code' => 200]);
                } else {
                    return response()->json(['message' => 'Entered Password is incorrect', 'code' => 400]);
                }
            } else {
                return response()->json(['message' => 'This email is not registered yet', 'code' => 400]);
            }
        }
    }
}
