<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoanApiController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api',['except' => ['login','register']]);
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|string|min:6'
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $token = auth()->guard('api')->login($user);
        return $this->createToken($token);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'bail|required',
            'password' => 'bail|required'
        ]);
        $credentials = request(['email', 'password']);
        $credentials['role'] = 0;

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createToken($token);
    }

    public function createToken($token) {
        return response()->json([
            'access_token' => $token,
            'type' => 'Bearer',
            'user' => auth()->guard('api')->user(),
        ]);
    }

    public function applyLoan(Request $request) {
        $request->validate([
            'amount' => 'bail|required|numeric',
        ]);
        $data = $request->only(['amount','terms']);
        $data['user_id'] = auth()->user()->id;
        Loan::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Loan is applied waiting for appoval'
        ]);
    }
}
