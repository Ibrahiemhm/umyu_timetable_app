<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;
use App\Models\User;
use App\Http\Controllers\Api\IssueTokenTrait;
use Validator;
use Carbon\Carbon;

class AuthController extends Controller
{

    use IssueTokenTrait;

	private $client;

	public function __construct(){
		$this->client = Client::find(2);
	}

    public function login(Request $request){

    	$validator = Validator::make($request->all('email', 'password'),[
			'email' => 'required|string|email|max:255',
			'password' => 'required|string|max:255'
		]);

		if ($validator->fails()) {
			return response(['errors' => $validator->errors()], 400);
		}

		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
			$user = $request->user();
			$tokenResult = $user->createToken("Personal Token");
			$tokenResult->expires_at = Carbon::now()->addWeeks(4);
			$token = $tokenResult->accessToken;

			return response([
				'success' => true,
				'user' => $user,
				'token' => $token,
			], 200);
		} else {
			$email = User::where('email', $request->email)->get();
			if ($email->isEmpty()) {
				return response([
					'success' => false,
					'error' => "The Email you entered is incorrect",
				], 422);	
			} else {
				return response([
					'success' => false,
					'error' => "The Password you entered is incorrect",
				], 422);
			}
		}
    }

    public function register(Request $request){

    	$validator = Validator::make($request->all('name', 'email', 'password'),[
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255',
			'password' => 'required|string|max:255'
		]);

		if ($validator->fails()) {
			return response(['errors' => $validator->errors()], 400);
		}

		$check = User::where('email', $request->email)->first();

		if($check == null){
			$newUser = new User();
			$newUser->name =  $request->name;
			$newUser->email = $request->email;
			$newUser->password = Hash::make($request->password);
			$newUser->save();

			if (Auth::attempt(['email' => $newUser->email, 'password' => $request->password])) {
				$user = $request->user();
				$tokenResult = $user->createToken("Personal Token");
				$tokenResult->expires_at = Carbon::now()->addWeeks(4);
				$token = $tokenResult->accessToken;

				return response([
					'success' => true,
					'user' => $user,
					'token' => $token,
				], 200);
			} else {
				$email = User::where('email', $request->email)->get();
				if ($email->isEmpty()) {
					return response([
						'success' => false,
						'error' => "The Email you entered is incorrect",
					], 422);	
				} else {
					return response([
						'success' => false,
						'error' => "The Password you entered is incorrect",
					], 422);
				}
			}
		} else {
			return response([
						'success' => false,
						'error' => "The email you entered has already been taken",
					], 422);
		}

		
    }

    public function logout(Request $request){

    	$accessToken = Auth::user()->token();

    	DB::table('oauth_refresh_tokens')
    		->where('access_token_id', $accessToken->id)
    		->update(['revoked' => true]);

    	$accessToken->revoke();

    	return response()->json([], 204);

    }
}
