<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exam\StoreRequest;
use App\Http\Requests\Exam\UpdateRequest;
use App\Models\Content;
use App\Models\ContentProgress;
use App\Models\Exam;
use App\Models\Material;
use App\Models\Student;
use App\Services\ContentService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    public function create(Material $material)
    {
        return view('resource.exam.create', [
            'title' => __('Add Exam'),
            'material' => $material,
        ]);
    }

    public function store(StoreRequest $request, Material $material)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $content = Content::create([
                'type' => 'exam',
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
            $validatedData['slug'] = Str::slug($validatedData['title']);

            $exam = Exam::create($validatedData);

            foreach ($students as $student) {

            }

            DB::commit();

            session()->flash('success', __('Exam successfully added'));

            return redirect()->route('material.show', $material);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to add exam'));

            return redirect()->back();
        }
    }

    public function show(Material $material, Exam $exam)
    {
        return view('resource.exam.show', [
            'title' => __('View Exam'),
            'material' => $material,
            'exam' => $exam,
        ]);
    }

    public function edit(Material $material, Exam $exam)
    {
        return view('resource.exam.edit', [
            'title' => __('Edit Exam'),
            'material' => $material,
            'exam' => $exam,
        ]);
    }

    public function update(UpdateRequest $request, Material $material, Exam $exam)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $validatedData['slug'] = Str::slug($validatedData['title']);

            $exam->update($validatedData);

            DB::commit();

            session()->flash('success', __('Exam successfully edited'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to edit exam'));

            return redirect()->back();
        }
    }

    public function destroy(Material $material, Exam $exam)
    {
        try {
            DB::beginTransaction();

            $exam->content()->forceDelete();
            $exam->forceDelete();

            ContentProgress::where('content_id', $exam->content_id)
                ->forceDelete();

            DB::commit();

            session()->flash('success', __('Exam successfully deleted'));

            return redirect()->route('material.show', $material);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to delete exam'));

            return redirect()->back();
        }
    }
}
