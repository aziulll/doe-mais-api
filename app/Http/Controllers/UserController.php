<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
    {
       $request->validate([
            'login' => ['required', ' string '],
            'email' => ['required', ' string '],
            'password' => ['required', 'string'],
            
        ]);

        $user = User::create([
            'login' => $request->login,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken($request->email)->plainTextToken;

        $response = [

            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }

   public function index() 
   {
       return User::all();
   }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken($request->email)->plainTextToken;


        $log = 'logou';
        $response = [
            'user' => $user,
            'token'=> $token,
            'log' => $log
        ];


      return response($response, 200);
        
    }

    public function user() 
    {
        $user = auth()->user();

        return response($user, 200);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        // Revoke all tokens issued to the user
        foreach ($user->tokens as $token) {
            $token->delete();
        }
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function show ($id) 
    {

        $user = User::findOrFail($id);

        return response()->json($user);

    }


   
}
