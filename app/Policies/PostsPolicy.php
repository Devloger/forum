<?php

namespace App\Policies;

use App\Models\Users;
use App\Models\Posts;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the posts.
     *
     * @param  \App\Models\Users  $user
     * @param  \App\Models\Posts  $posts
     * @return mixed
     */
    public function view(User $user, Posts $posts)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Models\Users  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the posts.
     *
     * @param  \App\Models\Users  $user
     * @param  \App\Models\Posts  $posts
     * @return mixed
     */
    public function update(Users $user, Posts $posts)
    {
        return ($user->id === $posts->author)
			OR
			($user->haveSectionRights($posts->topics->sections));
			
    }

    /**
     * Determine whether the user can delete the posts.
     *
     * @param  \App\Models\Users  $user
     * @param  \App\Models\Posts  $posts
     * @return mixed
     */
    public function delete(User $user, Posts $posts)
    {
        //
    }
}
