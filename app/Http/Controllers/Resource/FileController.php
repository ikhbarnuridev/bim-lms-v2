<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\StoreRequest;
use App\Models\Content;
use App\Models\ContentProgress;
use App\Models\File;
use App\Models\Material;
use App\Models\Student;
use App\Services\ContentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    public function show(File $file)
    {
        $filePath = public_path('storage/'.$file->path);

        return response()->file($filePath);
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

    public function update(Request $request, File $file)
    {
        //
    }

    public function destroy(File $file)
    {
        //
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
