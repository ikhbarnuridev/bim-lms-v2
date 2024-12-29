<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\CreateRequest;
use App\Http\Requests\Teacher\EditRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    public function index()
    {
        $search = request()->input('s');

        $query = User::whereRelation('roles', function ($q) {
            $q->where('name', 'teacher');
        });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('username', 'like', '%'.$search.'%');
            });
        }

        return view('resource.teacher.index', [
            'title' => __('Teacher List'),
            'search' => $search,
            'teachers' => $query->latest()
                ->paginate(10)
                ->appends(request()->query()),
        ]);
    }

    public function store(CreateRequest $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $user = User::create([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $user->assignRole('teacher');

            DB::commit();

            session()->flash('success', __('Teacher successfully added'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to add teacher'));

            return redirect()->back();
        }
    }

    public function edit(User $user)
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

        return redirect()->route('teacher.index')
            ->with('teacher', $user);
    }

    public function update(EditRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $user->update([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
            ]);

            if ($validatedData['password'] != null) {
                $user->update([
                    'password' => Hash::make($validatedData['password']),
                ]);
            }

            DB::commit();

            session()->flash('success', __('Teacher successfully updated'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to update teacher'));

            return redirect()->back()->withInput();
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->forceDelete();

            session()->flash('success', __('Teacher successfully deleted'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            session()->flash('error', __('Failed to delete teacher'));

            return redirect()->back();
        }
    }
}
