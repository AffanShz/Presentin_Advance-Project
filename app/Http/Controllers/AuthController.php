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
            Session::put('email', $email);

            return redirect('/master-tutorial');    
        }
    
        return back()->with('error', 'Gagal login. Silahkan cek kembali email dan password Anda.');
    }

    public function logout()
    {
        $token = Session::get('refreshToken');
        $baseUrl = config('services.jwt.url', 'https://jwt-auth-eight-neon.vercel.app');

        if ($token) {
            try {
                Http::withToken($token)->post($baseUrl . '/logout');
            } catch (\Exception $e) {
                // Ignore API error
            }
        }

        Session::flush();
        return redirect('/login')->with('success', 'Berhasil logout');
    }
}
