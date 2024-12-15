<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Auth\Authenticatable;

class LoginController extends Controller
{
    use Authenticatable;

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
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
        ];

        if (auth()->attempt($credential, $validatedData['remember_me'] ?? false)) {
            return redirect()->route('home');
        }

        session()->flash('error', __('Incorrect email or password'));

        return redirect()->back()->withInput();
    }
}
