<?php

namespace App\CustomClass;

use App\ResponseUser;
use App\Question;
use App\EvaluationUser;
use App\User;
use Carbon\Carbon;

class Evaluation {

    private $user;
    private $evaluation_id;

    function __construct($evaluation_id, User $user = null)
    {
        $this->user = $user ?? auth()->user();
        $this->evaluation_id = $evaluation_id;
    }

    public function allQuestionsAnswered()
    {
        $questions = Question::select('id')
                            ->where('evaluation_id', $this->evaluation_id)
                            ->get();

        $answerQuestions = ResponseUser::where('user_id', $this->user->id)
                                ->whereIn('question_id', $questions->pluck('id') );

        return $questions->count() === $answerQuestions->count();
    }

    public function send()
    {
        $evaluation = EvaluationUser::where('user_id', $this->user->id)
                                ->where('evaluation_id', $this->evaluation_id)
                                ->first();
        $evaluation->update([
            'send_at' => Carbon::now()
        ]);
    }

}