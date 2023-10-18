<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ResetPasswordRequest;
use App\models\PasswordReset;
use App\Customer;
use Str;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    public function sendMail(Request $request)
    {
        
        $user = Customer::where('email', $request->email)->first();
        if($user){
            $passwordReset = PasswordReset::updateOrCreate([
                'email' => $user->email,
            ], [
                'token' => Str::random(60),
            ]);
            if ($passwordReset) {
                $user->notify(new ResetPasswordRequest($passwordReset->token));
            }
      
            return back()->with('success','Chúng tôi sẽ gửi thông báo về email của bạn');
        }else{
            return back()->with('error', 'Email không tồn tại');
        }
        
    }
    public function reset(Request $request, $token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return back()->with('message', 'Link đã hết bạn');
        }
        $user = Customer::where('email', $passwordReset->email)->first();
        $user->password = bcrypt($request->new_password);
        $user->save();
        $passwordReset->delete();
        return redirect(route('login.index'));
    }
    public function getReset($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();
        $data['email'] = $passwordReset->email;
        if($passwordReset){
            return view('auth.reset_pass',$data);
        }
    }
}
