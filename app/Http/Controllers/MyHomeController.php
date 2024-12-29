<?php

namespace App\Http\Controllers;

class MyHomeController extends Controller
{
    public function __invoke()
    {
        $role = auth()->user()->getRoleNames()[0];

        return view('my-home.' . $role, [
            'title' => __('Home'),
        ]);
    }
}
