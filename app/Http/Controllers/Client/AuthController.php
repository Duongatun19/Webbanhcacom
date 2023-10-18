<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\User;
use Auth,Validator;
use App\Notifications\CustomerRigisterNotify;
use App\Notifications\testNoti;
use App\models\Bill\BillDetail;
use App\models\Bill\Bill;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::guard('customer')->attempt($credentials)){
            return redirect('/')->with('success', 'Đăng nhập thành công');
        }else{
            return back()->with('error', 'Đăng nhập thất bại vui lòng kiểm tra thông tin')->withInput();
        }
        
    }
    public function register()
    {
        return view('auth.register');
    }
    public function postRegister(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:customer',
                'password' => 'required|min:8',
                'name' => 'required',
                'phone' => 'required'
            ]);
            if ($validator->fails()) {
                return back()
                            ->withErrors($validator)
                            ->withInput();
            }
            $data = new Customer();
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->status = 0;
            $data->save();
            if($data){
                return view('auth.login')->with('success','Đăng ký tài khoản thành công');
            }
    }
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }
    public function accoungOrder(){
        $profile = Auth::guard('customer')->user();
        $data['bill'] = Bill::where('code_customer',$profile->id)->get();
        return view('auth.account-order',$data);
    }
    public function accoungOrderDetail($billid){
        $data['bill'] = Bill::where('code_bill',$billid)->first();
        $data['billdetail'] = BillDetail::where('code_bill',$billid)->get();
        return view('auth.account-order-detail',$data);
    }
}
