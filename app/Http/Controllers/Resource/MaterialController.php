<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Material\StoreRequest;
use App\Http\Requests\Material\UpdateRequest;
use App\Models\Material;
use App\Models\User;
use App\Services\MaterialService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    public function index()
    {
        $search = request()->input('s');

        $query = Material::query();

        if (! auth()->user()->isAdmin()) {
            $query->where('teacher_id', auth()->id());
        }

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
            'teachers' => User::whereRelation('roles', 'name', '=', 'teacher')->get(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            if (isset($validatedData['cover'])) {
                $validatedData['cover'] = $validatedData['cover']->store('material/cover', 'public');
            }

            $validatedData['slug'] = Str::slug($validatedData['title']);
            $validatedData['order'] = (new MaterialService)->getNextOrder();
            $validatedData['teacher_id'] = $validatedData['teacher_id'] ?? auth()->id();

            $material = Material::create($validatedData);

            DB::commit();

            session()->flash('success', __('Material successfully added'));

            return redirect()->route('material.show', $material);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to add material'));

            return redirect()->back();
        }
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
        return view('resource.material.edit', [
            'title' => __('Edit Material'),
            'material' => $material,
            'teachers' => User::whereRelation('roles', 'name', '=', 'teacher')->get(),
        ]);
    }

    public function update(UpdateRequest $request, Material $material)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            if (isset($validatedData['cover'])) {
                if ($material->cover != null && file_exists(public_path('storage/'.$material->cover))) {
                    File::delete(public_path('storage/'.$material->cover));
                }

                $validatedData['cover'] = $validatedData['cover']->store('material/cover', 'public');
            } else {
                $validatedData['cover'] = $material->cover;
            }

            $validatedData['slug'] = Str::slug($validatedData['title']);
            $validatedData['teacher_id'] = $validatedData['teacher_id'] ?? auth()->id();

            $material->update($validatedData);

            DB::commit();

            session()->flash('success', __('Material successfully updated'));

            return redirect()->route('material.edit', $material);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to update material'));

            return redirect()->back();
        }
    }

    public function destroy(Material $material)
    {
        try {
            DB::beginTransaction();

            if ($material->cover != null && file_exists(public_path('storage/'.$material->cover))) {
                File::delete(public_path('storage/'.$material->cover));
            }

            $material->forceDelete();

            DB::commit();

            session()->flash('success', __('Material successfully deleted'));

            return redirect()->route('material.index');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to delete material'));

            return redirect()->back();
        }
    }

    public function reorder() {}
}
