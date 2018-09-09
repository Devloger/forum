<?php

namespace App\Policies;

use App\Models\Topics;
use App\Models\Users;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicsPolicy
{
    use HandlesAuthorization;

    public function create_post(Users $user, Topics $temat)
    {
        return $temat->status === 1 OR $user->haveSectionRights($temat->sections);
    }
}
