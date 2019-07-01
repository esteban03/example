<?php

namespace App\Traits\UserController;

use Illuminate\Http\Request;
use App\EvaluationUser;
use App\CategoryQuestion;
use App\ResponseUser;
use Illuminate\Support\Facades\Gate;
use App\CustomClass\Evaluation;

trait EvaluationTrait {

    public function viewEvaluation($user_id, $evaluation_id)
    {
        $evaluationUser = EvaluationUser::with(['evaluation.questions.answer' => function($q) use ($user_id) {
            $q->where('user_id', $user_id);
        }])
        ->where('evaluation_id', $evaluation_id)
        ->where('user_id', $user_id)
        ->firstOrFail();

        $evaluation = $evaluationUser->evaluation;
        if ( Gate::denies('view-evaluation-user', $evaluation) ) {
            abort(403, 'No autorizado');
        }

        $categorys_id  = $evaluation->questions->pluck('category_id')->unique();
        $categorys     = CategoryQuestion::whereIn('id', $categorys_id)->get();

        return view('user.evaluation', compact(
            'evaluationUser','evaluation','categorys','answers'
        ));
    }

    public function answerEvaluation(Request $request)
    {
        $this->validate( $request, [
            'question_id' => 'required',
            'alternative' => 'required'
        ]);

        ResponseUser::updateOrCreate([
            'user_id'     => auth()->user()->id,
            'question_id' => $request->question_id
        ], [
            'question_id' => $request->question_id,
            'response'    => $request->alternative
        ]);

        return ['status' => 'ok'];
    }

    public function sendEvaluation(Request $request, $evaluation_id)
    {

        $evaluation = new Evaluation( $evaluation_id );

        if (! $evaluation->allQuestionsAnswered() ) {
            return response(['status' => 'bad'], 500);
        }

        $evaluation->send();
        return ['status' => 'ok'];

    }

}