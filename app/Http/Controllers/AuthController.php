<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(\Illuminate\Http\Request $request)
    {
        // get credentials from the request
        $credentials = $request->only([ 'email', 'password' ]);
        
        // attempt to verify the credentials and create a token for the user
        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }
        // something went wrong whilst attempting to encode the token
        return response()->json(['error' => 'could_not_create_token'], 500);
    }

    public function register(Request $request)
    {
        $validator = \Validator::make(Request::all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|regex:/\w*[0-9]{1,}\w*/'
        ]);

        if($validator->fails()) {
            $error = $validator->message()->toJson();
            return response()->json(['success' => false, 'error' => $error]);
        }

        $user = new \App\User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->save();

        $token = $this->guard()->attempt(['email' => $user->email, 'password' => request('password')]);
        return $this->respondWithToken($token);
    }

    // get authenticated user
    public function me(){
        return response()->json($this->guard()->user());
    }

    // refresh token
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    // define guard to be used during authentification
    public function guard()
    {
        return Auth::guard();
    }

    // get the token array structure
    protected function respondWithToken($token)
    {
        return response()->json([
            'acces_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }
}
