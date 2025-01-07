<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialStatus;
use App\Models\Student;
use App\Models\User;

class MyHomeController extends Controller
{
    public function __invoke()
    {
        $role = auth()->user()->getRoleNames()[0];
        $data = [];

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
        } elseif ($role == 'teacher') {
            //
        } else {
            $data = [
                'materialTotal' => Material::count(),
                'teacherTotal' => User::whereRelation('roles', 'name', '=', 'teacher')->count(),
                'studentTotal' => Student::count(),
            ];
        }

        return view('my-home.'.$role, [
            'title' => __('Home'),
            ...$data,
        ]);
    }
}
