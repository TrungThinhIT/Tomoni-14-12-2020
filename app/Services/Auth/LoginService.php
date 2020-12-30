<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function getIndex()
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $remember = ($request->remember_me) ? true : false;
        if (Auth::attempt((['uname' => $request->uname, 'password' => $request->password]), $remember)) {
            $user = Auth::user();
            if($user->type != 2){
                return redirect()->intended(route('customer.index'));
            }else{
                return redirect()->intended(route('index'));
            }
        } else {
            $request->flash('request', $request->all());
            Session()->flash('message_error', 'Sai tên đăng nhập hoặc mật khẩu!');
            return back();
        }
    }
}
