<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\UpdateOrderRequest;
use App\Http\Requests\Question\StoreRequest;
use App\Http\Requests\Question\UpdateRequest;
use App\Models\Content;
use App\Models\Exam;
use App\Models\Material;
use App\Models\Question;
use App\Services\QuestionService;
use Exception;
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

    public function show(Material $material, Exam $exam, Question $question)
    {
        return view('resource.question.show', [
            'title' => __('View Question'),
            'material' => $material,
            'exam' => $exam,
            'question' => $question,
        ]);
    }

    public function edit(Material $material, Exam $exam, Question $question)
    {
        return view('resource.question.edit', [
            'title' => __('Edit Question'),
            'material' => $material,
            'exam' => $exam,
            'question' => $question,
        ]);
    }

    public function update(UpdateRequest $request, Material $material, Exam $exam, Question $question)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $question->update($validatedData);

            DB::commit();

            session()->flash('success', __('Question successfully updated'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to update question'));

            return redirect()->back();
        }
    }

    public function destroy(Material $material, Exam $exam, Question $question)
    {
        try {
            DB::beginTransaction();

            $question->answers()->forceDelete();
            $question->options()->forceDelete();
            $question->forceDelete();

            DB::commit();

            session()->flash('success', __('Question successfully deleted'));

            return redirect()->route('exam.show', [$material, $exam]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to delete question'));

            return redirect()->back();
        }
    }

    public function orderEdit(Question $question)
    {
        $availableOrders = Question::where('exam_id', $question->exam_id)
            ->get()
            ->pluck('order')
            ->toArray();

        $script = '
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const modalElement = document.getElementById("reorderModal");
                const modal = new coreui.Modal(modalElement);
                modal.show();
            });
        </script>
        ';

        return redirect()->back()->with([
            'question' => $question,
            'availableOrders' => $availableOrders,
            'script' => $script,
        ]);
    }

    public function orderUpdate(UpdateOrderRequest $request, Question $question)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $currentOrder = $question->order;

            $question->update([
                'order' => 0,
            ]);

            Question::where('exam_id', $question->exam_id)
                ->where('order', $validatedData['to'])
                ->first()
                ->update([
                    'order' => $currentOrder
                ]);

            $question->update([
                'order' => $validatedData['to'],
            ]);

            DB::commit();

            session()->flash('success', __('Urutan soal berhasil diperbarui'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Gagal memperbarui urutan soal'));

            return redirect()->back();
        }
    }
}
