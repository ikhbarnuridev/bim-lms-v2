<?php

namespace App\Http\Controllers;

class MyHomeController extends Controller
{
    public function __invoke()
    {
        return view('my-home', [
            'title' => __('Home'),
        ]);
    }
}
