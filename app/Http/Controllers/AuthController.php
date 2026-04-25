<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $response = Http::post('https://jwt-auth-eight-neon.vercel.app/login',
        [
            'email' => $email,
            'password' => $password,
        ]
        );

        if ($response->successful()) {

            $token = $response->json('refreshToken');

            Session::put('refreshToken', $token);

            return redirect('/master-tutorial');    
        }
    
        return back()->with('error', 'Gagal login. Silahkan cek kembali email dan password Anda.');
    }

    public function logout()
    {
        $token = Session::get('refreshToken');

        $response = Http::withToken($token)
            ->get('https://jwt-auth-eight-neon.vercel.app/logout');

        if($response->successful()){
            Session::forget('refreshToken');
            return redirect('/login');
        }

        return back()->with('error', 'Gagal logout');
    }
}
