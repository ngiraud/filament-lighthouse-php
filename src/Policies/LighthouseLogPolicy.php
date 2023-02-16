<?php

namespace Ngiraud\FilamentLighthouse\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Ngiraud\FilamentLighthouse\Models\LighthouseLog;

class LighthouseLogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, LighthouseLog $log)
    {
        return $log->isGenerated();
    }

    public function generate(User $user)
    {
        return true;
    }
}
