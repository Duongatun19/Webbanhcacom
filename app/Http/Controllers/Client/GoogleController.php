<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Customer;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
            
            $finduser = Customer::where('google_id', $user->id)->first();
     
            if($finduser){
                Auth::guard('customer')->login($finduser);
    
                return redirect('/')->with('success', 'Đăng nhập thành công');
     
            }else{
                $newUser = Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'status'=>0,
                    'password' => bcrypt('cubon123456789')
                ]);
    
                Auth::guard('customer')->login($newUser);
     
                return redirect('/')->with('success', 'Đăng nhập thành công');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
