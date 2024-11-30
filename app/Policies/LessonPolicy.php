<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Lesson $lesson)
    {
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
}
