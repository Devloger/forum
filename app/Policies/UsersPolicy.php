<?php

namespace App\Policies;

use App\Models\Users;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersPolicy
{
    use HandlesAuthorization;

    public function update(Users $user, Users $edit)
    {
        return $user->login === $edit->login;
    }
    
    public function sendMessage(Users $user, Users $to)
	{
		return $to->id !== $user->id AND $to->status === 1;
	}
	
	public function createNewMessage(Users $user, Users $to)
	{
		return auth()->check();
	}

}