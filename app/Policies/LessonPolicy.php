<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
{
    use HandlesAuthorization;

    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('lessons', 'view');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Lesson $lesson)
    {
        // If user is admin, allow access
        if ($user->hasRole('admin')) {
            return true;
        }

        // If lesson is not premium, allow access
        if (!$lesson->is_premium) {
            return true;
        }

        // Check if user is enrolled in the course
        if ($lesson->course->enrollments()->where('user_id', $user->id)->exists()) {
            return true;
        }

        // Check if user is enrolled in any parent course (if applicable)
        // Add your parent course check logic here if needed

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('lessons', 'create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Lesson $lesson)
    {
        return $user->hasPermission('lessons', 'update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Lesson $lesson)
    {
        return $user->hasPermission('lessons', 'soft-delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Lesson $lesson)
    {
        return $user->hasPermission('lessons', 'restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Lesson $lesson)
    {
        return $user->hasPermission('lessons', 'delete');
    }
}
//        // If user is admin, allow access
//        if ($user->hasRole('admin')) {
//            return true;
//        }
//
//        // If lesson is not premium, allow access
//        if (!$lesson->is_premium) {
//            return true;
//        }
//
//        // Check if user is enrolled in the course
//        if ($lesson->course->enrollments()->where('user_id', $user->id)->exists()) {
//            return true;
//        }
//
//        // Check if user is enrolled in any parent course (if applicable)
//        // Add your parent course check logic here if needed
//
//        return false;
