<?php

namespace App\Http\Controllers;

use App\Models\Student;

class RankingController extends Controller
{
    public function __invoke()
    {
        $search = request()->input('s');

        $query = Student::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRelation('user', 'name', 'like', '%'.$search.'%')
                    ->orWhere('nis', 'like', '%'.$search.'%');
            });
        }

        return view('ranking', [
            'title' => __('Ranking'),
            'search' => $search,
            'students' => $query->latest()
                ->paginate(10)
                ->appends(request()->query()),
        ]);
    }
}
