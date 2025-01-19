<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()
            ->user()
            ->when(request('query'), function ($query) {
                $query->where('name', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('email', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('username', 'LIKE', '%' . request('query') . '%');
            })
            ->when(request('status'), function ($query) {
                if (request('status') == 'banned') $query->banned();
                if (request('status') == 'active')  $query->active();
            })
            ->with('blogs')
            ->paginate(10);

        return view('backend.admin.users', compact('users'));
    }

    public function status(User $user)
    {
        $user->update([
            'status' => $user->status === 'banned' ? 'active' : 'banned'
        ]);

        return redirect()->route('users.index');
    }
}
