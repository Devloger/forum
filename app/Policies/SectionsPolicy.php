<?php

namespace App\Policies;

use App\Models\Sections;
use App\Models\Users;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectionsPolicy
{
    use HandlesAuthorization;

    public function create_topic(Users $user, Sections $section)
    {
        return $section->status === 1 OR $user->haveSectionRights($section);
    }
}
