<?php

namespace App\Http\Controllers\MyAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassword\UpdateRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ChangePasswordController extends Controller
{
    public function __invoke()
    {
        return view('my-account.change-password', [
            'title' => __('Change Password'),
        ]);
    }

    public function update(UpdateRequest $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            auth()->user()->update([
                'password' => Hash::make($validatedData['password']),
            ]);

            DB::commit();

            session()->flash('success', __('Password successfully updated'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to update password'));

            return redirect()->back()->withInput();
        }
    }
}
