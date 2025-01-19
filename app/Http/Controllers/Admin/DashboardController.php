<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::user()->count();
        $totalActiveUsers = User::user()->active()->count();
        $totalBannedUsers = User::user()->banned()->count();
        $totalBlogs = Blog::count();
        $activeBlogs = Blog::active()->count();
        $inactiveBlogs = Blog::inActive()->count();

        return view('backend.admin.dashboard', compact('totalUsers', 'totalActiveUsers', 'totalBannedUsers', 'totalBlogs', 'activeBlogs', 'inactiveBlogs'));
    }
}
