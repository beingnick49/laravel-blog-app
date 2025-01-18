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
            ->where('role', 'user')
            ->with('blogs')
            ->whereHas('blogs')
            ->paginate(10);

        return view('backend.admin.users.index', compact('users'));
    }

    public function status(User $user)
    {
        $user->update([
            'status' => $user->status === 'banned' ? 'active' : 'banned'
        ]);

        return redirect()->route('users.index');
    }
}
