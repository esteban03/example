<?php

namespace App\Policies;

use App\Evaluation;
use App\EvaluationUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * check if the user is assigned the evaluation
     *
     * @param User $user
     * @param Evaluation $evaluation
     * @return boolean
     */
    public function viewEvaluation(User $user, Evaluation $evaluation) {
        $count = EvaluationUser::where('user_id', $user->id)
                        ->where('evaluation_id', $evaluation->id)
                        ->count();
        return $count > 0 ? true : false;
    }

}
