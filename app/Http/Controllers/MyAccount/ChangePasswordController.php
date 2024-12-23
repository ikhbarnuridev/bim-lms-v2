<?php

namespace App\Http\Controllers\MyAccount;

use App\Http\Controllers\Controller;

class ChangePasswordController extends Controller
{
    public function __invoke()
    {
        return view('my-account.change-password', [
            'title' => __('Change Password'),
        ]);
    }

    public function update() {}
}
