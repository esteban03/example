<?php

use Illuminate\Database\Seeder;
use App\EvaluationUser;

class EvaluationUsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=3; $i < 6; $i++) {
            EvaluationUser::create([
                'user_id' => $i,
                'evaluation_id' => 1
            ]);
        }

        for ($i=7; $i < 10; $i++) {
            EvaluationUser::create([
                'user_id' => $i,
                'evaluation_id' => 2
            ]);
        }
    }
}
