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
            'title' => __('Material List'),
            'search' => $search,
            'materials' => $query->latest()
                ->paginate(10)
                ->appends(request()->query()),
        ]);
    }

    public function create()
    {
        return view('resource.material.create', [
            'title' => __('Add Material'),
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Material $material)
    {
        return view('resource.material.show', [
            'title' => __('View Material'),
            'material' => $material,
        ]);
    }

    public function edit(Material $material)
    {
        //
    }

    public function update(Request $request, Material $material)
    {
        //
    }

    public function destroy(Material $material)
    {
        //
    }
}
