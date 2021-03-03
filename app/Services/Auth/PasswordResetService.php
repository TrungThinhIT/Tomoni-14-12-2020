<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\PasswordResetRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use DB;

class PasswordResetService
{
    public function getIndex()
    {
        return view('auth.password_reset');
    }

    public function doSendToken(Request $request)
    {
        $request->validate([
            'email' => 'email:rfc,dns',
        ]);

        $email = $request->email;

        $resultEmail = User::where('email', $email)->first();
        if (empty($resultEmail)) {
            Session()->flash('message_error', 'Email không đúng, vui lòng thử lại');
            return back();
        }
        else {
            $checkEmail = PasswordReset::where('email', $email)->orderBy('expiration_date', 'DESC')->get()->first();
            if ($checkEmail != null && now() <= $checkEmail->expiration_date) {
                Session()->flash('message_error', 'Thư đổi mật khẩu đã tồn tại, vui lòng kiểm tra hoặc đợi sau 5 phút!');
                return back();
            } else {
                $resultName = User::where('email', $email)->first();
                $resultReset = new PasswordReset;
                $resultReset->email = $email;
                $resultReset->token = Str::random(80);
                $resultReset->expiration_date = now()->addMinutes(5);
                $resultReset->save();
                $this->email = $resultReset['email'];
                $this->token = $resultReset['token'];
                $this->name = $resultName['fullname'];
                Mail::send('commons.send_password', array('fullname' => $this->name, 'token' => $this->token), function ($message) {
                    $message->to($this->email, $this->name)->subject('Lấy lại mật khẩu');
                });
                Session()->flash('message_success', 'Link đổi mật khẩu đã gửi về email của bạn, vui lòng kiểm tra trong thư rác');
                return back();
            }
        }
    }

    public function getTokenChangePassword($token){
        $result = PasswordReset::where('token', $token)->first();
        if (!empty($result)) {
            $resultDate = $result->expiration_date;
            if (now() <= $resultDate) {
                $token = $result['token'];
                return view('auth.change_password', ['token' => $token]);
            } else {
                PasswordReset::where('token', $token)->delete();
                return view('commons.403');
            }
        } else {
            return view('commons.403');
        }
    }

    public function doChangePasswordReset(PasswordResetRequest $request){
        $rePassword = $request['re_password'];
        $token = $request['token'];
        $checkToken = PasswordReset::where('token', $token)->get()->first();

        if ($checkToken) {
            $findEmail = PasswordReset::where('token', $token)->get()->first();
            $user = User::where('email', $findEmail->email)->first();
            User::where('email', $findEmail->email)->update([
                'password' => md5($rePassword)
             ]);
            if ($user) {
                Auth::login($user);
                PasswordReset::where('token', $token)->delete();
                if($user->type != 2){
                    return redirect()->intended(route('customer.index'));
                }else{
                    return redirect()->intended(route('index'));
                }
            } else {
                Session()->flash('message_error', 'Đã có lỗi xảy ra, vui lòng liên hệ quản trị viên!');
                return back();
            }
        } else {
            Session()->flash('message_error', 'Đã có lỗi xảy ra, vui lòng liên hệ quản trị viên!');
            return back();
        }
    }
}
