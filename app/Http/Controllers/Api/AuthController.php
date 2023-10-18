<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Carbon\Carbon;
use Auth,Hash,DB;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    public function login(Request $request,User $admin)
    {
    	$request->validate($admin->rule());
    	$arr = request(['name','password']);
    	if (!Auth::attempt($arr)) {
    		return response()->json([
                'code' => 500,
    			'message'=>'Sai mật khẩu'
    		],401);
    	}else{
    		$user = $request->user();
	        $tokenResult = $user->createToken('Personal Access Token');
	        $token = $tokenResult->token;
	        if ($request->remember_me){
	            $token->expires_at = Carbon::now()->addWeeks(1);
	        }
	        $token->save();

		        return response()->json([
	            'success' => true,
                'message' => '',
                'data' => [
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'user' => $user->toArray(),
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString()
                ]
	        ]);
    	}
    }
    public function logout(Request $request)
    {
    	$accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
        return response()->json([
            'message' => 'Logout Success'
        ], 200);
	}
	public function register(Request $request)
	{
		$user = new User();
		$user->name = $request->name;
		$user->avatar = $request->avatar;
		$user->phone = $request->phone;
		$user->code = rand();
		$user->password = Hash::make($request->password);
		$user->email = $request->email;
		$user->type = 1;
		$user->save();
	}
	public function authentication()
	{
        $user = Auth::user();
		return $user;
	}
}
