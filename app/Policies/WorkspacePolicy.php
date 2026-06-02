<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Auth\Access\Response;

class WorkspacePolicy
{
    public function view(User $user, Workspace $workspace): bool
    {
        return $user->id === $workspace->user_id;
    }

    public function create(User $user): bool
    {
        return true; // Any logged-in user can create a workspace
    }

    public function update(User $user, Workspace $workspace): bool
    {
        return $user->id === $workspace->user_id;
    }

    public function delete(User $user, Workspace $workspace): bool
    {
        return $user->id === $workspace->user_id;
    }
}