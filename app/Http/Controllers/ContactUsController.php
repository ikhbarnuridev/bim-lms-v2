<?php

namespace App\Http\Controllers;

class ContactUsController extends Controller
{
    public function __invoke()
    {
        return view('contact-us');
    }
}
