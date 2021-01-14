<?php

namespace App\Http\Controllers;

use JWTAuth;
use Validator;
use App\Models\User;
use App\Models\Userprofiles;
use App\Models\GradeTotals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['login','register']]);
    }

    public function login(Request  $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            log_activity('Login Successfully',url()->current(),  $request->method() ,Auth::user()->idusers);
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function guard()
    {
        return Auth::guard();
    }


    public function profile(Request $request)
    {         
        $user = Auth::user();
        log_activity('Show Profile',url()->current(), $request->method() ,$user->idusers);
        return response()->json(['user' => $user], 200);

    }

    public function register(Request $request)
    {    

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $register = new User;
        $register->name = $request->name;
        $register->role = $request->role;
        $register->email = $request->email;
        $register->password =  Hash::make($request->password);
        $register->save();
        
        $profile = new Userprofiles;
        $profile->idusers =   $register->idusers;
        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->mobile = $request->mobile;
        $profile->tempatlahir = $request->tempatlahir;
        $profile->jobrole = $request->jobrole;
        $profile->address = $request->address;
        $profile->save();

        // log_activity('Register Successfully',url()->current(), $request->method() ,Auth::user()->idusers);
        // $this->created_grade_totals(Auth::user()->idusers,0);
        
        $token = JWTAuth::fromUser($register);

        return response()->json([
                    'user' => $register,
                    'profile' => $profile,
                    'data_token' =>  $token 
        ], 200);    
    }


    public function logout(Request $request) {
        log_activity('Logout Successfully',url()->current(), $request->method() ,Auth::user()->idusers);
        Auth::logout();
        return response()->json(['message' => 'successfully signed out']);
    }

    protected function created_grade_totals($idusers,$total)
    {
        $grade_totals = new GradeTotals;
        $grade_totals->idusers =  $idusers;
        $grade_totals->total = $total;
        $grade_totals->save();

        return $grade_totals;
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }
}
