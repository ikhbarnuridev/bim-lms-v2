<?php

namespace App\Http\Controllers;

class UserGuideController extends Controller
{
    public function __invoke()
    {
        return view('user-guide', [
            'title' => __('User Guide'),
        ]);
    }
}
