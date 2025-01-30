<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy
{
    public function delete(User $user, Category $category): bool
    {
	return $user->id == $category->user_id;
    }

}
