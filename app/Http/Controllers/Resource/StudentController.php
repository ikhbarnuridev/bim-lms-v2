<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\CreateRequest;
use App\Http\Requests\Student\EditRequest;
use App\Models\Student;
use Database\Factories\UserFactory;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index()
    {
        $search = request()->input('s');

        $query = Student::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRelation('user', 'name', 'like', '%' . $search . '%')
                    ->orWhere('nis', 'like', '%' . $search . '%');
            });
        }

        return view('resource.student.index', [
            'title' => __('Student List'),
            'search' => $search,
            'students' => $query->latest()
                ->paginate(10)
                ->appends(request()->query()),
        ]);
    }

    public function store(CreateRequest $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $user = UserFactory::new()->create([
                'name' => $validatedData['name'],
                'username' => $validatedData['nis'],
                'password' => Hash::make($validatedData['nis']),
            ]);

            $user->assignRole('student');

            $validatedData['user_id'] = $user->id;

            Student::create($validatedData);

            DB::commit();

            session()->flash('success', __('Student successfully added'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to add student'));

            return redirect()->back();
        }
    }

    public function edit(Student $student)
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

        return redirect()->route('student.index')
            ->with('student', $student);
    }

    public function update(EditRequest $request, Student $student)
    {
        try {
            $validatedData = $request->validated();

            $student->update([
                'nis' => $validatedData['nis'],
            ]);

            $student->user()->update([
                'name' => $validatedData['name'],
            ]);

            session()->flash('success', __('Student successfully updated'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            session()->flash('error', __('Failed to update student'));

            return redirect()->back()->withInput();
        }
    }

    public function destroy(Student $student)
    {
        try {
            $student->forceDelete();

            session()->flash('success', __('Student successfully deleted'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            session()->flash('error', __('Failed to delete student'));

            return redirect()->back();
        }
    }
}
