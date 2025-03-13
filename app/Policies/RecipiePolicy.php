<?php

namespace App\Policies;

use App\Models\Recipie;
use App\Models\User;

class RecipiePolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Recipie $recipie): bool
    {
        return $user->currentAccessToken()->can('delete');
    }
}
