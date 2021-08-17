<?php

namespace App\Policies;


use App\Models\Post;
use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any courses.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the course.
     *
     * @param  App\User  $user
     * @param  App\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $course)
    {
        //
    }

    /**
     * Determine whether the user can create courses.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      
    }

    /**
     * Determine whether the user can update the course.
     *
     * @param  App\User  $user
     * @param  App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $course)
    {
        //
        if($user->admin || $user->posts()->user_id == auth()->user()->id)
         {
              return true;
         }
         return false;
    }

    /**
     * Determine whether the user can delete the course.
     *
     * @param  App\User  $user
     * @param  App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $course)
    {
        //

        if ($user->admin) {
            return true;
        }
        return false;
    }
}
