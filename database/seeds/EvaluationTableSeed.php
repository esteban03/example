<?php

use Illuminate\Database\Seeder;
use App\Evaluation;

class EvaluationTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evaluation::create([
            'title'   => 'Evaluation 1',
            'user_id' => 2
        ]);
        Evaluation::create([
            'title'   => 'Evaluation 2',
            'user_id' => 3
        ]);
    }
}
