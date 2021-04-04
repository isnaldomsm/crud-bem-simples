<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Usuarios;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsuariosPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the usuarios.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Usuarios  $usuarios
     * @return mixed
     */
    public function view(User $user, Usuarios $usuarios)
    {
        // Update $user authorization to view $usuarios here.
        return true;
    }

    /**
     * Determine whether the user can create usuarios.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Usuarios  $usuarios
     * @return mixed
     */
    public function create(User $user, Usuarios $usuarios)
    {
        // Update $user authorization to create $usuarios here.
        return true;
    }

    /**
     * Determine whether the user can update the usuarios.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Usuarios  $usuarios
     * @return mixed
     */
    public function update(User $user, Usuarios $usuarios)
    {
        // Update $user authorization to update $usuarios here.
        return true;
    }

    /**
     * Determine whether the user can delete the usuarios.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Usuarios  $usuarios
     * @return mixed
     */
    public function delete(User $user, Usuarios $usuarios)
    {
        // Update $user authorization to delete $usuarios here.
        return true;
    }
}
