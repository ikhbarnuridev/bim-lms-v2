<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $search = request()->input('s');

        $query = User::whereDoesntHave('roles', function ($q) {
            $q->where('name', 'admin');
        });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('username', 'like', '%'.$search.'%');
            });
        }

        return view('resource.user.index', [
            'title' => __('User List'),
            'search' => $search,
            'users' => $query->latest()
                ->paginate(10)
                ->appends(request()->query()),
        ]);
    }
}
