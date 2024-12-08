<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function __invoke()
    {
        return view('auth.login', [
            'title' => __('Login'),
        ]);
    }

    public function submit(LoginRequest $request)
    {
        $validatedData = $request->validated();

        $credential = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ];

        if (auth()->attempt($credential, $validatedData['remember_me'] ?? false)) {
            return redirect()->route('home');
        }

        session()->flash('error', __('Incorrect email or password'));

        return redirect()->back()->withInput();
    }
}
