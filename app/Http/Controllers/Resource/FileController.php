<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\StoreRequest;
use App\Http\Requests\File\UpdateRequest;
use App\Models\Content;
use App\Models\ContentProgress;
use App\Models\File;
use App\Models\Material;
use App\Models\Student;
use App\Services\ContentService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    public function show(Material $material, File $file)
    {
        return view('resource.file.show', [
            'title' => __('View File'),
            'material' => $material,
            'file' => $file,
        ]);
    }

    public function store(StoreRequest $request, Material $material)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            if (isset($validatedData['file'])) {
                $validatedData['path'] = $validatedData['file']->store('material/file', 'public');
            }

            $content = Content::create([
                'type' => 'file',
                'order' => (new ContentService)->getNextOrder($material),
                'material_id' => $material->id,
            ]);

            $students = Student::all();
            foreach ($students as $student) {
                ContentProgress::create([
                    'student_id' => $student->id,
                    'content_id' => $content->id,
                ]);
            }

            $validatedData['content_id'] = $content->id;

            File::create($validatedData);

            DB::commit();

            session()->flash('success', __('File successfully uploaded'));

            return redirect()->route('material.show', $material);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to upload file'));

            return redirect()->back();
        }
    }

    public function edit(Material $material, File $file)
    {
        return view('resource.file.edit', [
            'title' => __('Edit File'),
            'material' => $material,
            'file' => $file,
        ]);
    }

    public function update(UpdateRequest $request, Material $material, File $file)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            if (isset($validatedData['file'])) {
                if (file_exists(public_path('storage/'.$file->path))) {
                    FacadesFile::delete(public_path('storage/'.$file->path));
                }

                $validatedData['path'] = $validatedData['file']->store('material/file', 'public');
            }

            $file->update($validatedData);

            DB::commit();

            session()->flash('success', __('File successfully updated'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to update file'));

            return redirect()->back();
        }
    }

    public function destroy(Material $material, File $file)
    {
        try {
            DB::beginTransaction();

            $file->content()->forceDelete();
            $file->forceDelete();

            ContentProgress::where('content_id', $file->content_id)
                ->forceDelete();

            DB::commit();

            session()->flash('success', __('File successfully deleted'));

            return redirect()->route('material.show', $material);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to delete file'));

            return redirect()->back();
        }
    }

    public function download(File $file)
    {
        $filePath = public_path('storage/'.$file->path);

        $contentProgress = ContentProgress::where('content_id', $file->content_id)
            ->where('student_id', auth()->user()->student->id)
            ->first();

        if ($contentProgress) {
            $contentProgress->update([
                'is_done' => true,
                'score' => 100,
            ]);
        }

        return response()->file($filePath);
    }
}
