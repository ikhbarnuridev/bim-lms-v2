<?php

namespace App\Http\Controllers;

use App\Models\Material;

class MyMaterialController extends Controller
{
    public function list()
    {
        $search = request()->input('s');

        $query = Material::query()
            ->whereRelation('materialStatuses', 'student_id', auth()->id());

        if ($search) {
            $query->where('title', 'like', '%'.$search.'%');
        }

        return view('my-material.list', [
            'title' => __('Material List'),
            'search' => $search,
            'materials' => $query->latest()
                ->paginate(10)
                ->appends(request()->query()),
        ]);
    }

    public function detail(Material $material)
    {
        return view('my-material.detail', [
            'title' => __('Material Detail'),
            'material' => $material,
        ]);
    }
}
