<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;

class BlogPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    private function isBlogOwnerOrAdmin(User $user, Blog $blog)
    {
        return $user->id === $blog->user_id || auth()->user()->role === 'admin';
    }

    public function show(User $user, Blog $blog)
    {
        return $this->isBlogOwnerOrAdmin($user, $blog);
    }

    public function edit(User $user, Blog $blog)
    {
        return $this->isBlogOwnerOrAdmin($user, $blog);
    }

    public function update(User $user, Blog $blog)
    {
        return $this->isBlogOwnerOrAdmin($user, $blog);
    }

    public function delete(User $user, Blog $blog)
    {
        return $this->isBlogOwnerOrAdmin($user, $blog);
    }
}
