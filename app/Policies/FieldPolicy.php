<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Field;

class FieldPolicy
{
    public function view(User $user)
    {
        return $user->hasAnyPermission(['Field access']);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('Field add');
    }

    public function update(User $user, Field $field)
    {
        return $user->hasPermissionTo('Field edit') || $field->user_id === $user->id;
    }

    public function delete(User $user, Field $field)
    {
        return $user->hasPermissionTo('Field delete') || $field->user_id === $user->id;
    }
}
