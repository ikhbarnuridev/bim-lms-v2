<?php

namespace App\Http\Controllers;

use App\Models\MaterialStatus;

class MyHomeController extends Controller
{
    public function __invoke()
    {
        $role = auth()->user()->getRoleNames()[0];

        if ($role == 'student') {
            $queryBase = MaterialStatus::query()
                ->where('student_id', auth()->id());

            $materialDoneTotal = (clone $queryBase)
                ->where('is_done', true)
                ->count();

            $materialNotDoneTotal = (clone $queryBase)
                ->where('is_done', false)
                ->count();

            $data = [
                'materialDoneTotal' => $materialDoneTotal,
                'materialNotDoneTotal' => $materialNotDoneTotal,
            ];
        }

        return view('my-home.'.$role, [
            'title' => __('Home'),
            ...$data,
        ]);
    }
}
