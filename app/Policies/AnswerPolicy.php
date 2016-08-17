<?php

namespace App\Policies;

use App\User;
use App\Answer;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Answer $answer)
    {
        return $user->id === $answer->user->id;
    }
}
