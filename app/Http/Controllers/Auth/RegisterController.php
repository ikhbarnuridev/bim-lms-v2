<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function __invoke()
    {
        return view('auth.register', [
            'title' => __('Register'),
        ]);
    }

    public function submit(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $user = User::query()->create($validatedData);
            $user->assignRole('applicant');

            DB::commit();

            session()->flash('success', __('Registration success, please log in to continue'));

            return redirect()->route('login');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Registration failed, please try again later'));

            return redirect()->back()->withInput();
        }
    }
}
