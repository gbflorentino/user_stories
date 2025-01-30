<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function delete(User $user, User $model): bool
    {
	return $user->id == $model->user_id;
    }
}
