<?php

namespace App\Http\Controllers\MyAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $role = $user->getRoleNames()[0];

        return view('my-account.profile.'.$role, [
            'title' => __('Profile'),
            'user' => $user,
        ]);
    }

    public function update(UpdateRequest $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();
            $user = auth()->user();

            if (isset($validatedData['photo'])) {
                if ($user->photo != null && file_exists(public_path('storage/'.$user->photo))) {
                    File::delete(public_path('storage/'.$user->photo));
                }

                $validatedData['photo'] = $validatedData['photo']->store('user/photo', 'public');
            } else {
                $validatedData['photo'] = $user->photo;
            }

            $user->update($validatedData);

            DB::commit();

            session()->flash('success', __('Profile successfully updated'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to update profile'));

            return redirect()->back()->withInput();
        }
    }
}
