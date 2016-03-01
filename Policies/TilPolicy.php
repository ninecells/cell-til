<?php

namespace NineCells\Til\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class TilPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function tilEdit($user, $item)
    {
        return $user->id === $item->writer_id;
    }
}
