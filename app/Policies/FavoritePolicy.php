<?php

namespace App\Policies;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoritePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Favorite $favorite)
    {
        return $user->id === $favorite->user_id;
    }

    public function update(User $user, Favorite $favorite)
    {
        return $user->id === $favorite->user_id;
    }

    public function delete(User $user, Favorite $favorite)
    {
        return $user->id === $favorite->user_id;
    }
}
