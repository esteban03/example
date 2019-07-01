<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Evaluation;

class EvaluationExport implements FromView
{

    use Exportable;

    private $evaluation_id;

    function __construct($evaluation_id)
    {
        $this->evaluation_id = $evaluation_id;
    }

    public function view(): View
    {
         $evaluation = Evaluation::with(['user','evaluateds','questions.category','questions.answers'])
                                ->find( $this->evaluation_id );
        return view('exports.evaluation', [
            'evaluation' => $evaluation
        ]);
    }
}
