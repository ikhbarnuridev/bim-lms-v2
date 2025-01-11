<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\StoreRequest;
use App\Models\Exam;
use App\Models\Material;
use App\Models\Question;
use App\Services\QuestionService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    public function store(StoreRequest $request, Material $material, Exam $exam)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $validatedData['exam_id'] = $exam->id;
            $validatedData['order'] = (new QuestionService)->getNextOrder($exam);

            Question::create($validatedData);

            DB::commit();

            session()->flash('success', __('Question successfully added'));

            return redirect()->route('exam.show', [$material, $exam]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to add question'));

            return redirect()->back();
        }
    }

    public function show(Question $question)
    {
        //
    }

    public function edit(Question $question)
    {
        //
    }

    public function update(Request $request, Question $question)
    {
        //
    }

    public function destroy(Question $question)
    {
        //
    }
}
