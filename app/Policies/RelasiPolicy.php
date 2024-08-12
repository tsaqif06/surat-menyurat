<?php

namespace App\Policies;

use App\Models\Relasi;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RelasiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Relasi  $relasi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Relasi $relasi)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Relasi  $relasi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Relasi $relasi)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Relasi  $relasi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Relasi $relasi)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Relasi  $relasi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Relasi $relasi)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Relasi  $relasi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Relasi $relasi)
    {
        //
    }
}
