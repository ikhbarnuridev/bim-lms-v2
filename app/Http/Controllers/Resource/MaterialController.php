<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $search = request()->input('s');

        $query = Material::query();

        if ($search) {
            $query->where('title', 'like', '%'.$search.'%');
        }

        return view('resource.material.index', [
            'title' => __('Course List'),
            'search' => $search,
            'materials' => $query->latest()
                ->paginate(10)
                ->appends(request()->query()),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
