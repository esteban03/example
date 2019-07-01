<?php

namespace App\Http\Controllers;

use App\Exports\EvaluationExport;
use App\Evaluation;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke($evaluation_id)
    {
        $evaluation = Evaluation::findOrFail($evaluation_id);
        return Excel::download(new EvaluationExport($evaluation_id),  $evaluation->title.'.xlsx');
    }
}
