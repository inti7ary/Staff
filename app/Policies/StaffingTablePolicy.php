<?php

namespace App\Policies;

use App\StaffingTable;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffingTablePolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
        LOG::debug("POLICY BEFORE");
        if ($user->role === 'admin' || $user->role === 'moderator') {
            return true;
        }
    }
    /**
     * Determine whether the user can view any staffing tables.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the staffing table.
     *
     * @param  \App\User  $user
     * @param  \App\StaffingTable  $staffingTable
     * @return mixed
     */
    public function view(User $user, StaffingTable $staffingTable)
    {
        return true;
    }

    /**
     * Determine whether the user can create staffing tables.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        
    }

    /**
     * Determine whether the user can update the staffing table.
     *
     * @param  \App\User  $user
     * @param  \App\StaffingTable  $staffingTable
     * @return mixed
     */
    public function update(User $user, StaffingTable $staffingTable)
    {
        LOG::debug("POLICY UPDATE".$user);
        return $user->role === 'admin' || $user->role === 'moderator';
    }

    /**
     * Determine whether the user can delete the staffing table.
     *
     * @param  \App\User  $user
     * @param  \App\StaffingTable  $staffingTable
     * @return mixed
     */
    public function delete(User $user, StaffingTable $staffingTable)
    {
        //
    }

    /**
     * Determine whether the user can restore the staffing table.
     *
     * @param  \App\User  $user
     * @param  \App\StaffingTable  $staffingTable
     * @return mixed
     */
    public function restore(User $user, StaffingTable $staffingTable)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the staffing table.
     *
     * @param  \App\User  $user
     * @param  \App\StaffingTable  $staffingTable
     * @return mixed
     */
    public function forceDelete(User $user, StaffingTable $staffingTable)
    {
        //
    }
}
