<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function __invoke(Request $request)
    {
        $file_path = public_path('storage/'.$request->get('filePath'));

        return response()->download($file_path);
    }
}
