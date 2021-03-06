<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                    ]
                    ]);
                    
                    $token = $response->getBody();

                    $data = json_decode($token, true);

                    $user = User::where('email', $request->username)->with('role.rules')->get();

                    $rules = $user->pluck('role')->collapse()->pluck('rules');

                    $rules->put('access_token', $data['access_token']);

                    return response()->json($rules);
                } catch (\GuzzleHttp\Exception\BadResponseException $e) {
                    if ($e->getCode() === 400) {
                        return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
                    } else if ($e->getCode() === 401) {
                        return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }
            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }

    public function show()
    {
        return User::where('id', auth()->user()->id)->with('role.rules')->get();
    }
    
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

       

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->role()->attach(Role::where('role', 'Admin')->first());

        return response($user, 200);
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json('Logged out successfully', 200);
    }
}
