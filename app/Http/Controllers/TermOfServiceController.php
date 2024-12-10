<?php

namespace App\Http\Controllers;

class TermOfServiceController extends Controller
{
    public function __invoke()
    {
        return view('term-of-service');
    }
}
