<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\EvaluationUser;
use App\Evaluation;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ( Auth::user()->hasRole(['admin']) ) {
            return $this->admin($request);
        }

        if( Auth::user()->hasRole(['jefatura']) ) {
            return $this->jefatura();
        }

        return $this->evaluado();
    }

    private function admin($request)
    {
        $evaluations = Evaluation::with('user')->get();

        if ( $request->input('evaluation_id') ) {
            $evaluation = Evaluation::with(['user','evaluateds','questions.category','questions.answers'])
                                ->findOrFail( $request->evaluation_id );
        }

        return view('home.admin', compact('evaluations','evaluation'));
    }

    private function jefatura()
    {
        $userEvaluations = EvaluationUser::whereHas('evaluation', function($q) {
            $q->where('user_id', Auth::user()->id);
        })->with(['evaluation', 'user'])->get();
        return view('home.jefatura', compact('userEvaluations'));
    }

    private function evaluado()
    {
        $userEvaluations = EvaluationUser::with(['evaluation.user'])
                            ->where('user_id', Auth::user()->id)
                            ->get();
        return view('home.user', compact('userEvaluations'));
    }


}
