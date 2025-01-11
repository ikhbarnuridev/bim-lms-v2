<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Option\StoreRequest;
use App\Http\Requests\Option\UpdateRequest;
use App\Models\Option;
use App\Models\Question;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OptionController extends Controller
{
    public function store(StoreRequest $request, Question $question)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            Option::updateOrInsert(
                [
                    'label' => $validatedData['label'],
                ],
                [
                    'question_id' => $question->id,
                    ...$validatedData,
                ]
            );

            DB::commit();

            session()->flash('success', __('Option successfully added'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to add option'));

            return redirect()->back();
        }
    }

    public function edit(Option $option)
    {
        $script = '
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const modalElement = document.getElementById("editModal");
                const modal = new coreui.Modal(modalElement);
                modal.show();
            });
        </script>
        ';

        session()->flash('script', $script);
        session()->flash('option', $option);

        return redirect()->back();
    }

    public function update(UpdateRequest $request, Option $option)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $option->update($validatedData);

            DB::commit();

            session()->flash('success', __('Option successfully updated'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to update option'));

            return redirect()->back();
        }
    }

    public function destroy(Option $option)
    {
        try {
            DB::beginTransaction();

            $option->forceDelete();

            DB::commit();

            session()->flash('success', __('Option successfully deleted'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to delete option'));

            return redirect()->back();
        }
    }
}
